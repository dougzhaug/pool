<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\Api\ApiPreconditionFailedHttpException;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Test;
use Carbon\Carbon;
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
}
