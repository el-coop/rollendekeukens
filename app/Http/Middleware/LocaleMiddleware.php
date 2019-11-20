<?php

namespace App\Http\Middleware;

use App;
use Closure;

class LocaleMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->session()->has('appLocale') && array_key_exists($request->session()->get('appLocale'), config('app.locales'))) {
            App::setLocale($request->session()->get('appLocale'));
        } else if ($user = $request->user()) {
            App::setLocale($user->language);
        }
        
        
        return $next($request);
    }
}
