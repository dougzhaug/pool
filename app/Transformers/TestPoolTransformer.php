<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18 0018
 * Time: 17:19
 */

namespace App\Transformers;

use App\Models\TestPool;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class TestPoolTransformer extends TransformerAbstract
{
    public function transform(TestPool $testPool)
    {
        // 在这里可以使用你的转换层转换给出的响应

        return [
            'id'=> $testPool->id,
            'score'=>$testPool->score,
            'pool_id' => $testPool->pool->id,
            'question'=> $testPool->pool->question,
            'answers'=> $testPool->pool->answers,
            'full_marks'=>$testPool->pool->score,
            'sn'=> $testPool->pool->sn,
            'status' => $testPool->pool->status,
            'surplus' => (new Carbon())->diffInSeconds(Carbon::parse($testPool->test->expires),false)
        ];
    }
}