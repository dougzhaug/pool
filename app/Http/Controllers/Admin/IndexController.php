<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class IndexController extends AuthController
{
    //
    public function index()
    {
        return view('admin.index.index');
        echo "后台首页";die;
    }
    public function demo()
    {
        return view('layouts.demo');
        echo "后台首页";die;
    }
}
