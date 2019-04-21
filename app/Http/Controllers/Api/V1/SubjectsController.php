<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Subject;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;

class SubjectsController extends AuthController
{
    //
    public function index(Request $request){
        $subjects = Subject::where('status',1)->select(['id','name','profile'])->get();
        foreach ($subjects as $k=>$v){
            $subjects[$k]['present'] = 0;
            $subjects[$k]['hash'] = get_string_hash($v['id'],7);
            if($v['id'] == $request->user['subject_id']){
                $subjects[$k]['present'] = 1;
            }
        }
        return $this->response->array($subjects);
    }

    public function toggle(Request $request)
    {

        $result = $request->user->update(['subject_id'=>$request->subject_id]);

        if($result){
            return $this->response->noContent();
        }else{
            throw new UpdateResourceFailedException('网络异常');
        }
    }
}
