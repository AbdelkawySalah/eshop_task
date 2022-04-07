<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Cat;
use App\Models\Setting;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('front.layouts.navbar',function($view){
            $view->with('catspro',Cat::select('id','name')->get());
            $view->with('sett',Setting::select('logo')->first());
        });
        view()->composer('front.layouts.head',function($view){
            $view->with('sett',Setting::select('favicon')->first());
        });
        view()->composer('front.layouts.footer',function($view){
            $view->with('sett',Setting::first());
        });
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
