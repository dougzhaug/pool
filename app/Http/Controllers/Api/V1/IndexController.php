<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AuthController
{
    //
    public function index()
    {
//        throw new \Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException('数据异常',null,403);
        return ['我是v1'];
    }
}
