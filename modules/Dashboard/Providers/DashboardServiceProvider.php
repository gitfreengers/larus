<?php namespace Modules\Dashboard\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class DashboardServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the application events.
	 * 
	 * @return void
	 */
	public function boot()
	{
		$this->registerConfig();
		$this->registerTranslations();
		$this->registerViews();
		$this->registerMenu();
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{		
		//
		$this->registerWidgets();
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('dashboard.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'dashboard'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/dashboard');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'dashboard');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/dashboard');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'dashboard');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'dashboard');
		}
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

	/**
	 * Bind the Registrar class for the widgets
	 */
	public function registerWidgets()
	{
		$this->app->singleton('app.widgets', 'Modules\Dashboard\Repositories\Widgets');
	}

	public function registerMenu()
	{

			$menu = Menu::instance('sidebar-menu');
			$menu->route('dashboard', 'Dashboard', [], 1, ['icon' => 'fa fa-dashboard']);

	}

}
