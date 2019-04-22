<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22 0022
 * Time: 9:52
 */

namespace App\Http\Controllers\Service;

use App\Models\Pool;
use Illuminate\Support\Facades\DB;

class UserInitService extends Service
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * 添加用户与题目关联数据
     *
     * @return mixed
     */
    public function init()
    {
        $pool_id = Pool::pluck('id');
        $creates = [];
        foreach ($pool_id as $k=>$v){
            $creates[$k] = [
                'user_id'=>$this->user['id'],
                'pool_id'=>$v,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }

        return DB::table('user_pool')->insert($creates);
    }
}