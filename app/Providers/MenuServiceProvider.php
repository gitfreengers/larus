<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Menu;

class MenuServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if(!Menu::instance('sidebar'))
		{
			Menu::create('sidebar-menu', function ($menu) {
				$menu->setPresenter('App\Presenters\SidebarMenuPresenter');
				$menu->enableOrdering(); // enable ordering
			});
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
