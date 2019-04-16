<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BeforeRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $request->user = $user??null;                 //统一获取用户信息

        $this->handleDateRange($request);

        return $next($request);
    }

    /**
     * 处理时间选择器的开始时间和结束时间
     *
     * @param Request $request
     */
    private function handleDateRange(Request $request)
    {
        if($date_range = $request->date_range){
            list($start_date,$end_date) = explode(config('daterangepicker.separator'),$date_range);

            $request->start_date = $start_date;
            $request->end_date = $end_date;

            View::share([
                'start_date'=> $start_date,
                'end_date' => $end_date
            ]);
        }
    }

}
