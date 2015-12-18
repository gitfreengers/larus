<?php namespace Modules\Contabilidad\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class ContabilidadServiceProvider extends ServiceProvider {

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
		    __DIR__.'/../Config/config.php' => config_path('contabilidad.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'contabilidad'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/contabilidad');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'contabilidad');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/contabilidad');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'contabilidad');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'contabilidad');
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
			$sub->route('contabilidad.sales.index', 'Ventas',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('contabilidad.earrings.index', 'Pendientes',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('contabilidad.deposits.index', 'Depósitos',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('contabilidad.cancel.index', 'Cancelaciones',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('contabilidad.policies.index', 'Pólizas',[],1,['icon' => 'fa fa-circle-o']);
			$sub->dropdown('Reportes', 2, function ($sub2) {
				$sub2->route('contabilidad.oldBalance.index', 'Antigüedad de saldos',[],1,['icon' => 'fa fa-circle-o']);
				$sub2->route('contabilidad.oldBalance.index', 'Auxiliar de movimientos',[],1,['icon' => 'fa fa-circle-o']);
	
			}, ['icon' => 'fa fa-bar-chart']);
					
				$sub->dropdown('Importar', 2, function ($sub2) {
					$sub2->route('contabilidad.oldBalance.index', 'Estado de cuenta',[],1,['icon' => 'fa fa-circle-o']);
				}, ['icon' => 'fa fa-cloud-upload']);
						
		}, 2, ['icon' => 'fa fa-balance-scale']);
	
	}
}
