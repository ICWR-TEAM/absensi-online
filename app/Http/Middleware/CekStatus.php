<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect("login");
        }elseif (Auth::user()->role == $role) {
            return $next($request);
        }
        return redirect("login")->with("error", "Kamu tidak mempunyai akses login!");
    }
}
