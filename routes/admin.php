<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('Admin')->group(function () {
    //首页
    Route::get('/', 'IndexController@index')->name('index');
    //DEMO
    Route::get('/demo', 'IndexController@demo');

    //提示页面
    Route::get('prompt','PromptController@index')->name('prompt');

    /*** 登陆注册 ***/
    //登录
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    //注册
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
    //找回密码
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    //登出
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    /*** 登陆注册(完) ***/

    /*** 管理员管理 ***/
    Route::post('admins/index', 'AdminsController@index')->name('admins.index');
    Route::resource('admins', 'AdminsController');
    Route::post('admins/status/{admin}', 'AdminsController@status')->name('admins.status');

    //权限管理
    Route::post('permissions/index', 'Rbac\PermissionsController@index')->name('permissions.index');
    Route::resource('permissions', 'Rbac\PermissionsController');
    Route::get('permissions/create/{id?}', 'Rbac\PermissionsController@create')->name('permissions.create');
    Route::post('permissions/sort/{permission}', 'Rbac\PermissionsController@sort')->name('permissions.sort');
    Route::post('permissions/toggle_nav/{permission}', 'Rbac\PermissionsController@toggleNav')->name('permissions.toggle_nav');

    //角色管理
    Route::post('roles/index', 'Rbac\RolesController@index')->name('roles.index');
    Route::resource('roles', 'Rbac\RolesController');
    Route::post('roles/permission_tree/{role?}', 'Rbac\RolesController@permissionTree')->name('roles.permission_tree');
    Route::post('roles/status/{role?}', 'Rbac\RolesController@status')->name('roles.status');

});

