<?php namespace App\Providers;


use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LarusServiceProvider extends ServiceProvider {

	/**
	 * Service providers to load
	 * @var array
	 */
	protected $providers = [
		'App\Providers\MenuServiceProvider',
		'Cartalyst\Sentinel\Laravel\SentinelServiceProvider',
		'Collective\Html\HtmlServiceProvider',
		'Pingpong\Menus\MenusServiceProvider',
		'Pingpong\Modules\ModulesServiceProvider',
		'Laracasts\Flash\FlashServiceProvider',
		'UxWeb\SweetAlert\SweetAlertServiceProvider',
		'Pingpong\Widget\WidgetServiceProvider',
	];

	protected $aliases = [
		'Form' => 'Collective\Html\FormFacade',
		'Html' => 'Collective\Html\HtmlFacade',
		'Activation' => 'Cartalyst\Sentinel\Laravel\Facades\Activation',
		'Reminder'   => 'Cartalyst\Sentinel\Laravel\Facades\Reminder',
		'Sentinel'   => 'Cartalyst\Sentinel\Laravel\Facades\Sentinel',
		'Menu' => 'Pingpong\Menus\MenuFacade',
		'Module' => 'Pingpong\Modules\Facades\Module',
		'Flash' => 'Laracasts\Flash\Flash',
		'Alert' => 'UxWeb\SweetAlert\SweetAlert',
		'Widget' => 'Pingpong\Widget\WidgetFacade',
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
		$this->registerOtherProviders()->registerAliases();
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
	/**
	 * Register some Aliases
	 * @return $this
	 */
	protected function registerAliases()
	{
		foreach ($this->aliases as $alias => $original) {
			AliasLoader::getInstance()->alias($alias, $original);
		}
		return $this;
	}

}
