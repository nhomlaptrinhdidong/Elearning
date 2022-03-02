<?php

namespace App\Http\Middleware;

use App\Models\ChiTietLop;
use App\Models\Lop;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Student
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->loai_tai_khoan_id == 3) {
            $noti = ChiTietLop::where('tai_khoan_id', auth()->user()->username)->where('trang_thai', 0)->get();
            $lop = new Lop();
            View::share('notification', $noti);
            View::share('lop', $lop);
            return $next($request);
        }

        return redirect('/');
    }
}
