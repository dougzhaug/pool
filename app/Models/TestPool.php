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
    public function makeTestPool($test_id)
    {
        $pools = Pool::inRandomOrder()->take(2)->pluck('id'); //随机获取题目

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

    public function pool()
    {
        return $this->belongsTo('App\Models\Pool');
    }
}
