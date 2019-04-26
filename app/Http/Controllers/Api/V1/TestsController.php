<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\Api\ApiPreconditionFailedHttpException;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Test;
use App\Models\TestPool;
use App\Transformers\PoolTransformer;
use App\Transformers\TestPoolTransformer;
use Carbon\Carbon;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;

class TestsController extends AuthController
{
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

        (new Test())->submitTest($request);

        return $this->response->created();
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
            $testPool->score = $request->score;
            $testPool->save();
        }

        $builder = TestPool::where(['test_id'=>$request->user['test_id']])->with('pool');

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
