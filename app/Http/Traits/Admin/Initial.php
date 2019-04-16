<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/15 0015
 * Time: 11:05
 */

namespace App\Http\Traits\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

trait Initial
{
    /**
     * 设置模板类型
     *
     * @param $layout
     */
    protected function setLayout($layout=false)
    {
        View::share('layout',$layout ? trim($layout) : 'admin.layouts.fixed');
    }

    /**
     * 验证器
     *
     * @param $data
     * @param $rule
     * @return mixed
     */
    protected function validator($data,$rule)
    {
        return Validator::make($data, $rule)->validate();
    }

    /**
     * 设置多功能input框数据
     *
     * @param array $files
     */
    protected function setDropdownFiles($files=[])
    {
        View::share('dropdowns',$files);
    }
}