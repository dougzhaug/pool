<?php

namespace App\Http\Controllers\Api\Auth\MiniProgram;

use App\Http\Controllers\Api\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\PreconditionRequiredHttpException;

class LoginController extends BaseController
{
    //
    public function index(Request $request)
    {
        if(!$request->code || !$request->iv || !$request->encryptedData){
            throw new PreconditionRequiredHttpException('参数异常');
        }

        $miniProgram = app('wechat.mini_program');
        $session = $miniProgram->auth->session($request->code);

        $user = $miniProgram->encryptor->decryptData($session['session_key'], $request->iv, $request->encryptedData);

        $userModel = User::where('openid',$user['openId'])->first();
        if(!$userModel){
            $create = $user;
            $create['username'] = make_username();
            $create['openid']=$user['openId'];
            $create['nickname']=$user['nickName'];
            $create['avatar']=$user['avatarUrl'];
            $create['password']=bcrypt(config('auht.sns_user_default_password'));
            $create['expires']=date('Y-m-d H:i:s',time()+config('auth.sns_user_update_expires'));
            $userModel = User::create($create);
        }
        $token = auth('api')->login($userModel);

        header('Authorization: Bearer ' . (string)$token);

        return $this->response->noContent();

    }
}
