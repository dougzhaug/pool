<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Models\Feedback;
use App\Rules\phone;
use Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends AuthController
{
    //
    public function store(Request $request)
    {
        $rules = [
            'feedback' => ['required'],
//            'phone' => [new phone()]
        ];

        $payload = app('request')->only('feedback');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not create new Feedback.', $validator->errors());
        }

        $create = [
            'user_id'=>$request->user['id'],
            'feedback'=>$request->post('feedback'),
            'phone'=>$request->post('phone')??'',
        ];

        Feedback::create($create);

        return $this->response->created();


    }
}
