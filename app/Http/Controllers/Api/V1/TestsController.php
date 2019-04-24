<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\Api\ApiConflictHttpException;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Test;
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
        $pause = Test::where(['user_id'=>$request->user['id'],'subject_id'=>$request->user['subject_id'],'status'=>-2])->first();
        if($pause){
            throw new ApiConflictHttpException(40701);
        }
    }

    /**
     * 结束测试
     */
    public function end()
    {

    }

    /**
     * 暂停任务
     */
    public function pause()
    {

    }

    /**
     * 重新启动
     */
    public function restart()
    {

    }

    /**
     * 从头再来
     */
    public function startAllOver()
    {

    }
}
