<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $country = "world";
        //
        $siteurl=Request::server("HTTP_HOST");
        if (strpos($siteurl, 'ae.') !== false)
            $country="ae";
        else
        if (strpos($siteurl, 'sa.') !== false)
            $country="sa";    

        $config = app('config');
        $config->set('country', $country);
        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
