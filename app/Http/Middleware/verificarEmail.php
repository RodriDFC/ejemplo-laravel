<?php

namespace App\Http\Middleware;

use Closure;

class verificarEmail
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
        if(auth()->user()->isConfirmed()){
            return $next($request);
        }
        return redirect('/');

    }
}
