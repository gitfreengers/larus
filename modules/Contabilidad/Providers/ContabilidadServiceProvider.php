<?php namespace Modules\Contabilidad\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;
use Cartalyst\Sentinel\Native\Facades\Sentinel;


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
		
		if (!Sentinel::check()) {
			return redirect('login');
		}
	
		$menu = Menu::instance('sidebar-menu');
		if(	Sentinel::hasAccess('ventas.view') ||
		 	Sentinel::hasAccess('pendientes.view') ||
			Sentinel::hasAccess('depositos.view') ||
			Sentinel::hasAccess('cancelaciones.view') ||
			Sentinel::hasAccess('polizas.view') ||
			Sentinel::hasAccess('antiguedad.view') || 
			Sentinel::hasAccess('auxmovimientos.view') ||
		  	Sentinel::hasAccess('estadocuenta.view') ) {
			
			$menu->dropdown('Contabilidad', function ($sub) {
				if(Sentinel::hasAccess('ventas.view')) {
					$sub->route('contabilidad.ventas.index', 'Ventas',[],1,['icon' => 'fa fa-circle-o']);
				}
				if(Sentinel::hasAccess('pendientes.view')) {
					$sub->route('contabilidad.pendientes.index', 'Pendientes',[],1,['icon' => 'fa fa-circle-o']);
				}
				if(Sentinel::hasAccess('depositos.view')) {
					$sub->route('contabilidad.depositos.index', 'Depósitos',[],1,['icon' => 'fa fa-circle-o']);				
				}
				if(Sentinel::hasAccess('cancelaciones.view')) {
					$sub->route('contabilidad.cancelaciones.index', 'Cancelaciones',[],1,['icon' => 'fa fa-circle-o']);				
				}
				if(Sentinel::hasAccess('polizas.view')) {
					$sub->route('contabilidad.polizas.index', 'Pólizas',[],1,['icon' => 'fa fa-circle-o']);				
				}
				if(Sentinel::hasAccess('antiguedad.view') || Sentinel::hasAccess('auxmovimientos.view')) {
					$sub->dropdown('Reportes', 2, function ($sub2) {
						if(Sentinel::hasAccess('antiguedad.view')) {
							$sub2->route('contabilidad.antiguedad.index', 'Antigüedad de saldos',[],1,['icon' => 'fa fa-circle-o']);					
						}
						if(Sentinel::hasAccess('auxmovimientos.view')) {
							$sub2->route('contabilidad.antiguedad.index', 'Auxiliar de movimientos',[],1,['icon' => 'fa fa-circle-o']);
						}
			
					}, ['icon' => 'fa fa-bar-chart']);
				}
						
				if(Sentinel::hasAccess('estadocuenta.view')) {
					$sub->dropdown('Importar', 2, function ($sub2) {
							$sub2->route('contabilidad.antiguedad.index', 'Estado de cuenta',[],1,['icon' => 'fa fa-circle-o']);
					}, ['icon' => 'fa fa-cloud-upload']);
				}
						
			}, 2, ['icon' => 'fa fa-balance-scale']);
		}
	
	}
}
