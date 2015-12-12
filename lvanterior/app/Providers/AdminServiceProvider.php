<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AdminServiceProvider extends ServiceProvider {

    /**
     * @var array
     */
    protected $providers = [
        'App\Providers\WidgetServiceProvider',
        'Ekko\PackageTest\Providers\SimpleTestServiceProvider',
        'Ekko2\PackageTest\Providers\SimpleTestServiceProvider2',
    ];


	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->registerOtherProviders();



	}
    /**
     * Register other Service Providers
     * @return $this
     */
    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
        return $this;
    }




}
