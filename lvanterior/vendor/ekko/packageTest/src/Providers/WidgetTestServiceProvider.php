<?php namespace Ekko\PackageTest\Providers;

use Illuminate\Support\ServiceProvider;


class WidgetTestServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $widget = $this->app->make('dashboard.widget');


    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('dashboard.widget',
            'Ekko\PackageTest\Services\Widget\widgets');

    }


}
