<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pimpinan
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
        if(auth()->user()->level == 2){
            return $next($request);
        }

        return redirect('home')->with('error',"Only admin can access!");
    }
}
