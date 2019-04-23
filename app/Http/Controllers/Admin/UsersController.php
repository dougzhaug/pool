<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends AuthController
{
    //
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = User::select(['id','openid','nickname','phone','avatar','gender','status','subject_id','created_at'])->with('subject');

            /* where start*/

            if($request->keyword){
                $builder->where($request->current_field,'like','%'.$request->keyword.'%');
            }

            if($request->date_range){
                $builder->whereBetween('created_at',[$request->start_date,$request->end_date]);
            }

            /* where end */

            //获取总条数
            $total = $builder->count();

            /* order start */

            if($request->order){
                $order = $request->order[0];
                $order_column = $columns[$order['column']]['data'];
                $order_dir = $order['dir'];
                $builder->orderBy($order_column,$order_dir);
            }

            /* order end */

            $data = $builder->offset($request->start)->take($request->length)->get()->toArray();

            return [
                'draw' => intval($request->draw),
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
                'data' => $data,
            ];
        }

        $this->setDropdownFiles(['nickname'=>'昵称','phone'=>'手机号']);
        return view('admin.users.index');
    }

    /**
     * 删除
     *
     * @param User $user
     * @return array
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $result = $user->delete();
        if($result !== false){
            return ['errorCode'=>0,'message'=>'删除成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

    /**
     * 状态切换
     *
     * @param User $user
     * @param Request $request
     * @return array
     */
    public function status(User $user,Request $request)
    {
        $result = $user->update(['status'=>$request->status==1 ? -1 : 1]);
        if($result !== false){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
