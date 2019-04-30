<?php

namespace App\Models;

use App\Exceptions\Api\ApiHttpException;
use App\Exceptions\Api\ApiPreconditionFailedHttpException;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Test extends Model
{

    /**
     * 暂停测试
     *
     * @param Request $request
     * @return bool
     */
    public function pauseTest(Request $request)
    {
        $test_id = $request->user['test_id'];

        $test = $this->find($test_id);

        //判断是否已经提交过
        if($test['status'] == 2){
            throw new ApiPreconditionFailedHttpException(40703);
        }

        //判断是否已经暂停中
        if($test['status'] == -2){
            throw new ApiPreconditionFailedHttpException(40704);
        }
        $remainder = (new Carbon)->diffInSeconds(Carbon::parse($test['expires']),false);
        //判断是否已经到交卷时间
        if($remainder <= 0){
            throw new ApiPreconditionFailedHttpException(40705);
        }

        $test->status = -2;
        $test->remainder = $remainder;
        if(!$test->save()){
            throw new ApiHttpException(50201);
        }

        return true;
    }

    /**
     * 重新启动暂停的测试
     */
    public function restartTest(Request $request)
    {
        $test_id = $request->user['test_id'];

        $test = $this->find($test_id);

        //判断是否已经提交过
        if($test['status'] == 2){
            throw new ApiPreconditionFailedHttpException(40703);
        }

        //判断是否已经暂停中
        if($test['status'] == 1){
            throw new ApiPreconditionFailedHttpException(40702);
        }

        $test->status = 1;
        $test->expires = Carbon::now()->addSeconds($test['remainder']);
        $test->remainder = 0;
        if(!$test->save()){
            throw new ApiHttpException(50201);
        }

        return true;
    }

    /**
     * 生成新的测试
     *
     * @param Request $request
     * @return bool
     */
    public function makeNewTest(Request $request)
    {

        $pause = $this->where(['user_id'=>$request->user['id'],'subject_id'=>$request->user['subject_id'],'status'=>-2])->first();
        if($pause){
            throw new ApiPreconditionFailedHttpException(40701);
        }

        if($request->user['test_id']){
            throw new ApiPreconditionFailedHttpException(40702);
        }

        try{
            DB::beginTransaction();

            $this->subject_id=$request->user['subject_id'];
            $this->user_id =$request->user['id'];
            $this->status=1;
            $this->expires= Carbon::now()->addMinutes(config('pool.test_time'));
            $this->save();

            //生成测试数据
            $testPool = new TestPool();
            $testPool->makeTestPool($this->id,$request->user['subject_id']);

            //更新用户表中的test_id
            $request->user->update(['test_id'=>$this->id]);

            DB::commit();

            return true;
        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage(),['class'=>__CLASS__ ,'method'=>__METHOD__]);
            throw new ApiHttpException(50201);
        }

    }

    /**
     * 提交测试
     *
     * @param Request $request
     * @return bool
     */
    public function submitTest(Request $request)
    {
        $test_id = $request->user['test_id'];

        $test = $this->find($test_id);

        //判断是否已经提交过
        if($test['status'] == 2){
            throw new ApiPreconditionFailedHttpException(40703);
        }

        //获取试卷的得分
        $testPool = new TestPool();
        $score = $testPool->countScore($test_id);
        try{
            DB::beginTransaction();

            //更新测试表
            $test->score = $score;
            $test->status = 2;
            $test->submitted_at = Carbon::now();
            $test->save();

            //更新用户表中的test_id
            $request->user->update(['test_id'=>0]);

            DB::commit();

            return $score;
        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage(),['class'=>__CLASS__ ,'method'=>__METHOD__,'line'=>$e->getLine(),'code'=>$e->getCode()]);
            throw new ApiHttpException(50201);
        }
    }
}
