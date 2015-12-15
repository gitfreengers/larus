<?php namespace Modules\User\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\User\Widgets\TestAdvancedWidget;
use Modules\User\Widgets\TestMiddleWidget;
use Modules\User\Widgets\TotalUsersWidget;
use Menu;

class UserServiceProvider extends ServiceProvider {

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
		$this->registerWidget();
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
		    __DIR__.'/../Config/config.php' => config_path('user.php'),
		]);
		$this->mergeConfigFrom(
		    __DIR__.'/../Config/config.php', 'user'
		);
	}

	/**
	 * Register views.
	 * 
	 * @return void
	 */
	public function registerViews()
	{
		$viewPath = base_path('views/modules/user');

		$sourcePath = __DIR__.'/../Resources/views';

		$this->publishes([
			$sourcePath => $viewPath
		]);

		$this->loadViewsFrom([$viewPath, $sourcePath], 'user');
	}

	/**
	 * Register translations.
	 * 
	 * @return void
	 */
	public function registerTranslations()
	{
		$langPath = base_path('resources/lang/modules/user');

		if (is_dir($langPath)) {
			$this->loadTranslationsFrom($langPath, 'user');
		} else {
			$this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'user');
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
	 * Register Widgets
	 */
	public function registerWidget()
	{
		$widgets = app('app.widgets');
		$widgets->registerWidget([
			[
				'name' => 'totalUsers',
				'class' => TotalUsersWidget::class,
				'order' => 1,
				'group' => 'demo'
			],
			[
				'name' => 'testMiddle',
				'class' => TestMiddleWidget::class,
				'order' => 2,
				'group' => 'demo'
			],
			[
				'name' => 'testAdvanced',
				'class' => TestAdvancedWidget::class,
				'order' => 3,
				'group' => 'demo'
			],
		]);
	}

	public function registerMenu()
	{

		$menu = Menu::instance('sidebar-menu');
		$menu->dropdown('Gestión de usuarios', function ($sub) {
			$sub->route('users.index', 'Usuarios',[],1,['icon' => 'fa fa-circle-o']);
			$sub->route('roles.index', 'Roles', [], 2, ['icon' => 'fa fa-circle-o']);
		}, 2, ['icon' => 'fa fa-users']);

	}

}
