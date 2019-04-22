<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SyncUserPool;
use App\Models\Pool;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoolsController extends AuthController
{
    /**
     * 列表
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = Pool::select(['pools.id','question','answers','sn' ,'pools.status','subjects.name as subject','pools.created_at'])->join('subjects','subjects.id','=','pools.subject_id');

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

        $this->setDropdownFiles(['name'=>'姓名','phone'=>'手机号','email'=>'邮箱']);
        return view('admin.pools.index');
    }

    /**
     * 添加
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $subjects = Subject::where(['status'=>1])
            ->select('id','id as value','name')->get()->toArray();
        return view('admin.pools.create',['subjects'=>$subjects]);
    }

    /**
     * 添加程序
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validator($request->all(),[
            'subject_id' => 'required',
            'sn' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);

        $pool = new Pool();
        $pool->subject_id = $request->subject_id;
        $pool->sn = $request->sn;
        $pool->question = $request->question;
        $pool->answers = $request->answers;
        $pool->status = $request->status??0?1:0;
        $result = $pool->save();

        if($result){
            //添加队列
            $user = User::all();
            foreach ($user as $k=>$v){
                SyncUserPool::dispatch($pool,$v);
            }
            return success('添加成功','pools');
        }else{
            return error('网络异常');
        }

    }
    /**
     * 编辑
     *
     * @param Pool $pool
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Pool $pool)
    {
        $subjects = Subject::where(['status'=>1])
            ->select('id','id as value','name')->get()->toArray();
        return view('admin.pools.edit',['pool'=>$pool,'subjects'=>$subjects]);
    }

    /**
     * 编辑程序
     *
     * @param Request $request
     * @param Pool $pool
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pool $pool)
    {
        //
        $this->validator($request->all(),[
            'subject_id' => 'required',
            'sn' => 'required',
            'question' => 'required',
            'answers' => 'required',
        ]);

        $update = $request->post();

        $update['status'] = $update['status']??0?1:0;

        $result = $pool->update($update);

        if($result){
            return success('编辑成功','pools');
        }else{
            return error('网络异常');
        }
    }

    /**
     * 删除
     *
     * @param Pool $pool
     * @return array
     * @throws \Exception
     */
    public function destroy(Pool $pool)
    {
        $result = $pool->delete();
        if($result !== false){
            return ['errorCode'=>0,'message'=>'删除成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }

    /**
     * 状态切换
     *
     * @param Pool $pool
     * @param Request $request
     * @return array
     */
    public function status(Pool $pool,Request $request)
    {
        $result = $pool->update(['status'=>$request->status==1 ? -1 : 1]);
        if($result !== false){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
