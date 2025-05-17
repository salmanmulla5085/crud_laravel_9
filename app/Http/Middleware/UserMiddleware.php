<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
   public function handle(Request $request, Closure $next) {
        $user = session('user');
        if (!$user || $user->is_admin) {
            return redirect()->route('login')->with('error', 'Access restricted to User only.');;
        }
        return $next($request);
    }
}
