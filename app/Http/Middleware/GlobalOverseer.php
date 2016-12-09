<?php

namespace centaur\Http\Middleware;

use Closure;

class GlobalOverseer
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
        config(['app.timezone' => 'Asia/Kolkata']);
        config(['app.name' => 'Centaur']);
        
        return $next($request);
    }
}
