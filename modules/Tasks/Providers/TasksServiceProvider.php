<?php namespace Modules\Tasks\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Menu;

class TasksServiceProvider extends ServiceProvider {

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

		View::composer(['partials.header'], 'Modules\Tasks\Http\ViewComposers\TaskComposer');
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
		    __DIR__.'/../Config/config.php' => config_path('tasks.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'tasks'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/tasks');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'tasks');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/tasks');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'tasks');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'tasks');
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
		$menu->dropdown('Gestión de notificaciones', function ($sub) {
			$sub->route('tasks.index','Tareas',[],1,['icon'=> 'fa fa-tasks']);
			$sub->route('notifications.index','Notificaciónes',[],2,['icon'=> 'fa fa fa-envelope-o']);
		}, 3, ['icon' => 'fa fa-bell-o']);




	}


}
