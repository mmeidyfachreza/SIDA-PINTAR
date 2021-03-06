<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard="admin")
    {
        if(auth()->guard($guard)->check()||auth()->guard("web")->check()) {
            return $next($request);
        }
        return redirect(route('admin.login'));
    }
}
