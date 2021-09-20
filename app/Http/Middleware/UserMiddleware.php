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
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('loggedUser') && ($request->path() != '/' && $request->path() != '/register'))
        {
            return redirect('/');
        }
        if(session()->has('loggedUser') && ($request->path() == '/' || $request->path() == '/register'))
        {
            return back();
        }
        return $next($request);
    }
}
