<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends AuthController
{
    //
    public function index()
    {
        return Subject::where('status',1)->select(['id','name','profile'])->get();
    }
}
