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
        $api->get('/subjects','SubjectsController@index');
        $api->put('/toggle_subjects','SubjectsController@toggle');
        $api->get('/pools/get_next_or_last/{type}/{sn}/{tab_type}','PoolsController@getNextOrLast');
        $api->get('/pools/show/{id}','PoolsController@show');
        $api->get('/pools/list/{keyword?}','PoolsController@index');
        $api->put('/pools/status','PoolsController@status');
        $api->get('/my','MyController@index');

        $api->post('/feedback','FeedbackController@store');
        
        //测试
        $api->post('/tests/start','TestsController@start');
        $api->post('/tests/submit','TestsController@submit');
        $api->post('/tests/pause','TestsController@pause');
        $api->post('/tests/restart','TestsController@restart');
        $api->post('/tests/start_all_over','TestsController@startAllOver');
        $api->get('/tests/get_status','TestsController@getStatus');
        $api->get('/tests/list','TestsController@list');

        $api->post('/tests/get_test_question','TestsController@getTestQuestion');
    });
});
