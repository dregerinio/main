<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LocalUser
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
        // if (!str_starts_with($request->ip(), '192.168.0.') && !str_starts_with($request->ip(), '127.0.0.')) {
        //     return redirect('/not_found');
        // }
 
        return $next($request);
    }
}
