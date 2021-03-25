<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

//老方法 如果已经登录 默认跳转到/home
// return redirect(RouteServiceProvider::HOME);

//新方法，给出提示，跳转到主页
            session()->flash('info', '您已登录，无需再次操作。');
            return redirect('/');
        }

        return $next($request);
    }
}
