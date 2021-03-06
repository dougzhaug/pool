<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/24 0024
 * Time: 17:22
 */

namespace App\Exceptions\Api;


use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ApiConflictHttpException extends ConflictHttpException
{
    public function __construct($code=0, $previous=null)
    {
        parent::__construct(config('error.' . $code . '.message'),$previous,$code);
    }
}