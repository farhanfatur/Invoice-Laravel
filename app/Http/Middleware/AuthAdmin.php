<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->guard("admin")->user()) {
            return redirect()->route("adminLogin");
        }
        if (auth()->guard("web")->user()) {
            return redirect()->route("customerView");
        }

        return $next($request);
    }
}
