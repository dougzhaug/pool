<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\Rules\phone;
use Illuminate\Http\Request;
use Spatie\Permission\Guard;

class AdminsController extends AuthController
{

    /**
     * 首页
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if($request->isMethod('post')){

            $columns = $request->columns;

            $builder = Admin::select(['id','name','phone','email','status','created_at']);

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
        return view('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        return view('admin.admins.create',['roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required','unique:admins',new phone()],
            'email' => 'string|email|max:255|unique:admins',
            'password' => 'required|string|min:6',
            'roles' => 'required',
        ]);

        $create = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $admin = Admin::create($create);

        if(!$admin){
            return error('网络异常');
        }

        $result = $admin->assignRole($request->roles);

        if($result){
            return success('添加成功','admins');
        }else{
            return error('网络异常');
        }

    }

    /**
     * 展示页面
     *
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Admin $admin)
    {
        return view('admins.admin.show');
    }

    /**
     * @param Admin $admin
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Admin $admin)
    {
        $roles = Role::where(['status'=>1,'guard_name'=>Guard::getDefaultName(static::class)])
            ->select('id','id as value','name')->get()->toArray();
        $admin_roles = array_column($admin->roles->toArray(),'id') ? : [];  //获取当前用户的角色
        return view('admin.admins.edit',['admin'=>$admin,'roles'=>$roles,'admin_roles'=>$admin_roles]);
    }

    /**
     * @param Request $request
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $this->validator($request->all(),[
            'name' => 'required|string|max:255',
            'phone' => ['required',new phone()],
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:6',
            'roles' => 'required',
        ]);

        $update = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        if($request->password) $update['password'] = bcrypt($request->password);

        $admin_result = $admin->update($update);

        if(!$admin_result){
            return error('网络异常');
        }

        $result = $admin->syncRoles($request->roles);

        if($result){
            return success('编辑成功','admins');
        }else{
            return error('网络异常');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Admin $admin)
    {
        $result = $admin->delete();
        if($result){
            return success('删除成功','admins');
        }else{
            return error('网络异常');
        }
    }


    /**
     * 状态切换
     *
     * @param Admin $admin
     * @param Request $request
     * @return array
     */
    public function status(Admin $admin,Request $request)
    {
        $result = $admin->update(['status'=>$request->status==1 ? -1 : 1]);
        if($result !== false){
            return ['errorCode'=>0,'message'=>'修改成功'];
        }else{
            return ['errorCode'=>1,'message'=>'网络异常'];
        }
    }
}
