<?php
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

$params = [
    'version' => 'v1',
    'domain' => 'api.'.config('app.tld'),
    'namespace' => 'App\\Http\\Controllers\\Api',
];

$api->group($params, function ($api) {

    /**
     * Auth
     */
    $api->group(['namespace' => 'Auth'],function ($api){
        $api->post('/mini_program/login','MiniProgram\LoginController@index');
        $api->post('/mini_program/get_user_info','MiniProgram\LoginController@getUserInfo');
    });

    /**
     * V1
     */
    $api->group(['namespace' => 'V1'],function ($api){
        $api->get('/subjects','IndexController@index');
        $api->get('/pools/{subject}/{keyword?}','PoolsController@index');
    });
});
