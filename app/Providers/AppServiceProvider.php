<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DB::listen(function($query){
            //siempre que se ejecuta una consulta se activa
            $sql = $query->sql;
            $bindings = $query->bindings;
            $time = $query->time;
            //log($sql);
        });
    }
}
