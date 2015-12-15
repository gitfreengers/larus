<?php namespace Modules\Ejemplo\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class EjemploServiceProvider extends ServiceProvider {

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
	}

	/**
	 * Register config.
	 * 
	 * @return void
	 */
	protected function registerConfig()
	{
		$this->publishes([
		    __DIR__.'/../Config/config.php' => config_path('ejemplo.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'ejemplo'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/ejemplo');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'ejemplo');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/ejemplo');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'ejemplo');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'ejemplo');
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
	
	public function registerMenu()
	{
	
		$menu = Menu::instance('sidebar-menu');
		$menu->dropdown('Contabilidad', function ($sub) {
			$sub->route('sales.index', 'Ventas',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('oldBalance.index', 'Antigüedad de saldos',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('policies.index', 'Polizas',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('earrings.index', 'Pendientes de conciliar',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('deposits.index', 'Depositos',[],1,['icon' => 'fa fa-circle-o']);
		}, 2, ['icon' => 'fa fa-balance-scale']);
	
	}

}
