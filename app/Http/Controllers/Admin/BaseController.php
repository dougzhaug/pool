<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Admin\Initial;


class BaseController extends Controller
{
    use Initial;

    public function __construct()
    {
        $this->setLayout();
    }
}
