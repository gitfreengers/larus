<?php namespace Modules\User\Http\Middleware;


use Closure;
use Cartalyst\Sentinel\Native\Facades\Sentinel;


class AuthenticateSentinel {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(Sentinel::guest())
        {
            return redirect('login');

        }

        if(Sentinel::check()){

        }
		return $next($request);
	}

}
