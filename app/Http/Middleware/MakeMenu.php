<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MakeMenu
{
    /**
     * 生产导航
     *
     * @param $request
     * @param Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            $permissions = $user->getAllPermissions()->toArray();
            array_multisort(array_column($permissions,'sort'), SORT_DESC, $permissions);
            $menu = [];
            foreach ($permissions as $value){
                if($value['is_nav'] && $value['guard_name'] == $guard) $menu[] = $value;
            }
            View::share('menu',make_menu($menu));
        }
        return $next($request);
    }
}
