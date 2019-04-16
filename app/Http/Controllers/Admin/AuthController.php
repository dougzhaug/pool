<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends BaseController
{
    //
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $agent;
    public function __construct()
    {
        parent::__construct();
        $this->middleware([
            'auth:admin',
            'permission:admin',
            'menu:admin',
            'beforeRequest',
        ]);
    }


}
