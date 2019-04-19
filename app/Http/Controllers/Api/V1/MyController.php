<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyController extends AuthController
{
    //
    public function index(Request $request){
        $user = $request->user;
        $user['read_num'] = 100;
        $user['unread_num'] = 50;
        return $this->response->array($request->user);
    }
}
