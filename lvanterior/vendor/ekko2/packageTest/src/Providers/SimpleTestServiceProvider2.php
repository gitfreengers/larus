<?php namespace Ekko2\PackageTest\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SimpleTestServiceProvider2 extends ServiceProvider {

    /**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
        $widget = $this->app->make('dashboard.widget');
        $widget->itemsArray ([
            'permission'    =>  'TestWidget.view',
            'color'         =>  'bg-blue',
            'icon'          =>  'fa-envelope-o',
            'tittle'        =>  'clientes',
            'value'         =>  '1,555',
            'option'        =>   '1'
        ]);




        $this->setWidgetComposer($widget);
	}

	/**provider
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{





	}




    private function setWidgetComposer($widget)
    {
        View::composer('dashboard.dashboard', function ($view) use ($widget){
            $view->with('widget', $widget);
        });
        return $this;
    }





}
