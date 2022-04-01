<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        if (!Auth::check()) return redirect("/")->with("message", "Please Login First!");

        if (Auth::user()->position_id != 1) return redirect("/")->with("message", "Access Denied! As you are not an Admin.");

        return $next($request);
    }
}
