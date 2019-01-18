<?php

namespace App\Http\Middleware;

use Closure;

class permission
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
        if(auth()->check() && $request->user()->permission == 0) 
        {
            return redirect()->guest('home');
        }
        return $next($request);
    }
}
