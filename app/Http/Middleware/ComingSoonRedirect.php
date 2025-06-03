<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ComingSoonRedirect
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
        if(strpos($request->path(), 'install') === false && is_installed()){
            $setting = setting_item('enable_maintenance_mode');
            if ($setting) {
                if( !is_admin() && !($request->getRequestUri() == '/login' or $request->routeIs('site.down')) and $request->isMethod('get')){
                    return redirect()->route('site.down');
                }
            }
        }

        return $next($request);
    }
}
