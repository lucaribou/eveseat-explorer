<?php

namespace Seat\Cara\Explorer\Http\Middleware;

use Closure;

class SsoAuth
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
        if (!session()->has('sso-token')) {
            return redirect('explorer/auth')->with('error', trans('explorer::errors.not_sso_authenticated'));
        }

        return $next($request);
    }

}