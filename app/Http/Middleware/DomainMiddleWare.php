<?php

namespace App\Http\Middleware;

use Closure;

use IlluminateSupportFacadesApp;

class DomainMiddleWare
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
        $url_base_array = explode('.', parse_url($request->url(), PHP_URL_HOST));

        $url_full = $request->url();
        $url_full=str_replace("http://","",$url_full);
        $url_full=str_replace("https://","",$url_full);
        $url_array = explode('/', $url_full);


        $subdomain = $url_base_array[0];

        $languages = ['ae', 'sa'];

        if($subdomain=="med")
        {
            app()->instance('segment', "medical"); 
            if(isset($url_array[1]))
            {
                $subdomain = $url_array[1];
            }
            else
                $subdomain="en";
        }
        else
        {
            app()->instance('segment', "instrumentation"); 
        }

        app()->instance('url_full', $url_full);
        app()->instance('subdomain', $subdomain);
        app()->instance('url_array', $url_array);

        return $next($request)->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Application');
            
    }
}
