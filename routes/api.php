<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');
$api->version('v1',function ($api){
    $api->group(['namespace' => 'App\Http\Controllers\Api\Auth'],function ($api) {
        $api->get('/mini_program/login','MiniProgram\LoginController@index');
//        $api->get('/get_authorized_url','Auth\LoginController@getOpenAuthorizeUrl');
//        $api->get('/index/ad','V1\IndexController@ad');
//        $api->get('/index/icon','V1\IndexController@icon');
    });
});
