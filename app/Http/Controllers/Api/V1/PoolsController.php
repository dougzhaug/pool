<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Models\Pool;
use App\Transformers\PoolTransformer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoolsController extends BaseController
{
    //
    public function index()
    {
        $users = Pool::paginate(25);

        return $this->response->paginator($users, new PoolTransformer());
    }
}
