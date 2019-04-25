<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/25 0025
 * Time: 15:16
 */

namespace App\Exceptions\Api;


use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiHttpException extends HttpException
{
    public function __construct($code=50101, $previous=null,$header=[])
    {
        parent::__construct(500, config('error.' . $code . '.message'), $previous, $header, $code);
    }
}