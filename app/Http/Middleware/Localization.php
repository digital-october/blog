<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Localization
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
        if ( session()->has('locale')) {
            app()->setLocale(session()->get('locale'));

            Carbon::setLocale(session()->get('locale'));
        }

        return $next($request);
    }
}
