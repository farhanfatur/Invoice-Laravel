<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request)
    {
        if (! $request->expectsJson()) {
            return redirect()->route('adminLogin');
        }
    }
}
