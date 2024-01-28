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
            return redirect("/");
        }elseif (Auth::user()->role == $role) {
            return $next($request);
        }
        return redirect("/")->with("error", "Kamu tidak mempunyai akses login!");
    }
}
