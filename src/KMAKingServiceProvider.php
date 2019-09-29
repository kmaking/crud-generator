<?php

namespace KMAKing\CrudGenerator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use KMAKing\CrudGenerator\Commands\CrudGenerator;

class KMAKingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * publish admin template assets
         */
        $this->publishes([
            __DIR__.'/public' => public_path('vendors'),
            __DIR__.'/resources/views/components' => resource_path('views/components'),
            __DIR__.'/config/breadcrumbs.php' => base_path('config/breadcrumbs.php')
        ], 'kma-assets');

        /**
         * publish admin template auth views and components of boostrap
         */
        $this->publishes([
            __DIR__.'/resources/views/kma-auth' => resource_path('views/kma-auth')
        ], 'kma-auth');


        /**
         * Component register here
         * Bootstrap component register as laravel component
         */
        Blade::component('components.alert', 'alert');
        Blade::component('components.panel', 'panel');
        Blade::component('components.modal', 'modal');
        Blade::component('components.form', 'form');
        Blade::component('components.button', 'button');
        Blade::component('components.form-group', 'formGroup');
        Blade::component('components.datatable.style', 'DTStyle');
        Blade::component('components.datatable.script', 'DTScript');

        Blade::component('components.plugin.style', 'pluginStyle');
        Blade::component('components.plugin.script', 'pluginScript');
        // Blade::component('components.touchspin', 'touchspin');

        if ($this->app->runningInConsole()) {

            $this->commands([
                CrudGenerator::class,
            ]);

        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(resource_path('views/components'), 'component');
    }
}
