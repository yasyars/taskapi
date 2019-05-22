<?php

namespace App\Http\Middleware;

use Closure;

class Yasya 
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
        if ($request->username != 'yasya'){
            return redirect('/fail');
        }
        return $next($request);
    }
}