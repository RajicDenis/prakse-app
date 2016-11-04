<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Applic;

class AdminOrSelfApplic
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
	 * Middleware koji gleda jeli prijevljeni korisnik admin ili onaj o čijem profilu se radi
     */
    public function handle($request, Closure $next)
    {
		
		if(Auth::user()->isAdmin() || (Auth::user()->role == 'student' && Auth::user()->activeApplic() && Auth::user()->activeApplic()->id == $request->route('id'))){

			return $next($request);

		}
		
		return response('Unauthorized. You have to be admin or this user.', 401);
        
    }
}
