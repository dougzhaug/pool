<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AuthController
{
    //
    public function index()
    {
        return ['我是v2'];
    }
}
