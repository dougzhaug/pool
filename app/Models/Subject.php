<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //

    /**
     * 获取科目下拉
     *
     * @param bool $id
     * @param array $where
     * @return mixed
     */
    public static function getSubjectSelect($id=false,$where=[])
    {
        $selects = self::where(array_merge($where,['status'=>1]))->select(['id','name','id as value'])->get()->toArray();

        array_unshift($selects, ['name'=>'请选择','value'=>'']);

        if($id){
            foreach ($selects as $key=>$val){
                if($val['value'] == $id) $selects[$key]['selected'] = true;
            }
        }

        return $selects;
    }
}
