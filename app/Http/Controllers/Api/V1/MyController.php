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
        $user['subject'] = $user->subject;
        $user['read_num'] = $request->user->pools()->where('subject_id',$request->user['subject_id'])->wherePivot('status',1)->count();
        $user['unread_num'] = $request->user->pools()->where('subject_id',$request->user['subject_id'])->wherePivot('status',-1)->count();
        return $this->response->array($request->user);
    }
}
