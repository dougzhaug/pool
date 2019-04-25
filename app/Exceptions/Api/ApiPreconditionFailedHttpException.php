<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/25 0025
 * Time: 15:58
 */

namespace App\Exceptions\Api;


use Symfony\Component\HttpKernel\Exception\PreconditionFailedHttpException;

class ApiPreconditionFailedHttpException extends PreconditionFailedHttpException
{
    public function __construct($code=0, $previous=null)
    {
        parent::__construct(config('error.' . $code . '.message'),$previous,$code);
    }
}