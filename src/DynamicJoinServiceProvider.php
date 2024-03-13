<?php

Namespace RedDotDigitalIT\DynamicJoin;

Use Illuminate\Support\ServiceProvider;

Class DynamicJoinServiceProvider extends ServiceProvider {

    Public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->publishes([
            __DIR__.'/views' => resource_path('views'),
        ], 'dynamicjoin-views');
    
        $this->publishes([
            __DIR__.'/public' => public_path(),
        ], 'dynamicjoin-public');
    
        $this->publishes([
            __DIR__.'/database/migrations' => database_path('migrations'),
        ], 'dynamicjoin-migrations');
    }

    Public function register() {
    }
}

