<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\BaseController;
use App\Models\Pool;
use App\Models\UserPool;
use App\Transformers\PoolTransformer;
use Dingo\Api\Exception\StoreResourceFailedException;
use Dingo\Api\Exception\UpdateResourceFailedException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PoolsController extends AuthController
{
    /**
     * 列表首页
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request)
    {

        $builder = $request->user->pools()->where('subject_id',$request->user['subject_id']);
        if(in_array($request->keyword,['all','read','unread'])){
            switch ($request->keyword){
                case 'all':
                    break;
                case 'read':
                    $builder->wherePivot('status',1);
                    break;
                case 'unread':
                    $builder->wherePivot('status',-1);
            }
        }else{
            if($request->keyword ){
                $builder->where('question','like','%' . $request->keyword . '%');
            }

        }
        $pools = $builder->orderBy('sn','asc')->paginate($request->per_page??config('paginate.per_page'));

        return $this->response->paginator($pools, new PoolTransformer());
    }

    /**
     * 详情页
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function show(Request $request)
    {
        $user = Auth::user();
        $pools = $user->pools()->where('id',$request->id)->get();

        return $this->response->collection($pools, new PoolTransformer());
    }

    /**
     * 标记未已背或未背
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function status(Request $request)
    {
        $rules = [
            'pool_id' => ['required'],
            'status' => ['required']
        ];

        $payload = app('request')->only('pool_id', 'status');

        $validator = app('validator')->make($payload, $rules);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Could not put new status.', $validator->errors());
        }

        $result = UserPool::where(['user_id'=>$request->user['id'],'pool_id'=>$request->pool_id])->update(['status'=>$request->status == 1 ? -1 : 1]);
        if($result){
            return $this->response->noContent();
        }else{
            throw new UpdateResourceFailedException('网络异常');
        }
    }

    /**
     * 获取上一个或下一个
     *
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function getNextOrLast(Request $request)
    {

        $builder = $request->user->pools()->where('subject_id',$request->user['subject_id']);

        switch ($request->type){    //判断上一个/下一个
            case 'next':
                $builder->where('sn','>',$request->sn)->orderBy('sn','asc');
                break;
            case 'last':
                $builder->where('sn','<',$request->sn)->orderBy('sn','desc');
                break;
            default:
                throw new StoreResourceFailedException('类型异常');
        }

        switch ($request->tab_type){    //判断背书状态
            case 'all':
                break;
            case 'read':
                $builder->wherePivot('status',1);
                break;
            case 'unread':
                $builder->wherePivot('status',-1);
                break;
            default:
        }

        $pools = $builder->limit(1)->get();

        return $this->response->collection($pools, new PoolTransformer());
    }
}
