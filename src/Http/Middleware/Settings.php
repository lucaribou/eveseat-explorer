<?php

namespace Seat\Cara\Explorer\Http\Middleware;

use Closure;
use Seat\Cara\Explorer\Models\Setting;

class Settings
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

		$setting = Setting::all()->first();

		if(!$setting) return redirect('explorer/settings')->with('error', trans('explorer::errors.insert_settings'));

        return $next($request);
    }

}