<?php
/**
 * Created by PhpStorm.
 * User: coolong
 * Date: 2019/4/29
 * Time: 22:17
 */

namespace App\Transformers;


use App\Models\Test;
use League\Fractal\TransformerAbstract;

class TestTransformer extends TransformerAbstract
{
    public function transform(Test $test)
    {
        // 在这里可以使用你的转换层转换给出的响应
        $use_time = strtotime($test->expires)-strtotime($test->submitted_at)>0?strtotime($test->expires)-strtotime($test->submitted_at):0;
        return [
            'id'=> $test->id,
            'time'=>$test->created_at->format('Y-m-d H:i:s'),
            'score'=>$test->score,
            'useTime'=> config('pool.test_time')*60 - $use_time,
        ];
    }
}