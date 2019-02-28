<?php

namespace IAtelier\Atelier\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckEditor
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
	    if ( Auth::user()->id != 1 )
	    {
		    return redirect('home');
	    }
        return $next($request);
    }
}
