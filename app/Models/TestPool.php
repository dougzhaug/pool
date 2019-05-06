<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestPool extends Model
{
    //

    /**
     * 生成测试试卷
     *
     * @param $test_id
     * @return mixed
     */
    public function makeTestPool($test_id,$subject_id)
    {
//        $pools = Pool::inRandomOrder()->where(['subject_id'=>$subject_id])->take(config('pool.test_number'))->pluck('id'); //随机获取题目
        $pools10 = Pool::inRandomOrder()->where(['subject_id'=>$subject_id,'score'=>10])->take(3)->pluck('id')->toArray(); //随机获取三个10分题目
        $pools20 = Pool::inRandomOrder()->where(['subject_id'=>$subject_id,'score'=>20])->take(2)->pluck('id')->toArray(); //随机获取二个20分题目

        $pools = array_merge($pools10,$pools20);

        $create = [];
        foreach ($pools as $k=>$v){
            $create[$k] = [
                'test_id' => $test_id,
                'pool_id' => $v
            ];
        }

        return DB::table($this->getTable())->insert($create);
    }

    /**
     * 计算考试成绩
     */
    public function countScore($test_id)
    {
        return $this->where(['test_id'=>$test_id])->sum('score');
    }

    /**
     * 一对一 获取 题 信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pool()
    {
        return $this->belongsTo('App\Models\Pool');
    }

    /**
     * 一对多（方向） 获取测试信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function test()
    {
        return $this->belongsTo('App\Models\Test');
    }
}
