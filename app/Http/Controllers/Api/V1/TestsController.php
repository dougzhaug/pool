<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\Api\ApiPreconditionFailedHttpException;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Test;
use App\Models\TestPool;
use App\Transformers\PoolTransformer;
use App\Transformers\TestPoolTransformer;
use App\Transformers\TestTransformer;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

class TestsController extends AuthController
{
    /**
     * 获取测试成绩列表
     */
    public function list(Request $request)
    {
        $tests = Test::where(['user_id'=>$request->user['id'],'status'=>2])->orderBy('id','desc')->paginate($request->per_page??config('paginate.per_page'));

        return $this->response->paginator($tests, new TestTransformer());
    }

    /**
     * 开始测试
     *
     * @param Request $request
     */
    public function start(Request $request)
    {

        (new Test())->makeNewTest($request);

        return $this->response->created();
    }

    /**
     * 提交测试
     */
    public function submit(Request $request)
    {

        $score = (new Test())->submitTest($request);

        return $this->response->array(['score'=>$score]);
    }

    /**
     * 暂停任务
     */
    public function pause(Request $request)
    {

        (new Test())->pauseTest($request);

        return $this->response->created();
    }

    /**
     * 重新启动
     */
    public function restart(Request $request)
    {
        (new Test())->restartTest($request);

        return $this->response->created();
    }

    /**
     * 从头再来
     */
    public function startAllOver(Request $request)
    {
        $test = new Test();
        //关闭暂停中的项目
        $test->submitTest($request);

        //重新开启一个新测试
        $test->makeNewTest($request);

        return $this->response->created();
    }

    /**
     * 获取测试的状态
     */
    public function getStatus(Request $request)
    {
        $status = Test::where(['user_id'=>$request->user['id']])->orderBy('id','desc')->value('status');
        return $this->response->array(['status'=>$status]);
    }


    /********************************试卷*************************************/

    /**
     * 获取试题
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function getTestQuestion(Request $request)
    {
        //设置上一题分数
        if($request->id && $request->score){
            $testPool = TestPool::find($request->id);
            $test = $testPool->test;
            if((new Carbon())->diffInSeconds(Carbon::parse($test->expires),false) <= 0){
                throw new ApiPreconditionFailedHttpException(40705);    //已到交卷时间
            }
            $testPool->score = $request->score;
            $testPool->save();
        }

        $builder = TestPool::where(['test_id'=>$request->user['test_id']])->with(['pool','test']);

        if($request->current_id){
            $builder->where('id',$request->current_id);
        }else{
            switch ($request->type){    //判断上一个/下一个
                case 'next':
                    $builder->where('id','>',$request->id)->orderBy('id','asc');
                    break;
                case 'last':
                    $builder->where('id','<',$request->id)->orderBy('id','desc');
                    break;
                default:
                    $builder->orderBy('id','asc');
            }
        }

        $question = $builder->limit(1)->get();

        return $this->response->collection($question, new TestPoolTransformer());
    }
}
