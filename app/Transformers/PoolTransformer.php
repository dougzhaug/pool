<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18 0018
 * Time: 17:19
 */

namespace App\Transformers;


use App\Models\Pool;
use App\Models\UserPool;
use Dingo\Api\Http\Request;
use Dingo\Api\Transformer\Binding;
use League\Fractal\TransformerAbstract;

class PoolTransformer extends TransformerAbstract
{
    public function transform(Pool $pool)
    {
        // 在这里可以使用你的转换层转换给出的响应

        return [
            'id'=> $pool->id,
            'question'=> $pool->question,
            'answers'=> $pool->answers,
            'sn'=> $pool->sn,
            'status' => $pool->pivot->status
        ];
    }
}