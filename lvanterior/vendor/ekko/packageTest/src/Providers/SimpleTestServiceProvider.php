<?php namespace Ekko\PackageTest\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class SimpleTestServiceProvider extends ServiceProvider {

    protected $providers = [
        'Ekko\PackageTest\Providers\WidgetTestServiceProvider',
    ];

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
            'color'         =>  'bg-aqua',
            'icon'          =>  'fa-envelope-o',
            'tittle'        =>  'Menssdfsdfsdfsdfajes',
            'value'         =>  '1,sdfsdfsdfsdf430',
            'option'        =>   't'
        ]);
        $widget->itemsArray ([
            'permission'    =>  'TestWidget.view',
            'color'         =>  'bg-aqua',
            'icon'          =>  'fa-envelope-o',
            'tittle'        =>  'Menssdfsdfsdfsdfajes',
            'value'         =>  '1werwerwer,rtrwtertsdfsdfsdfsdf430',
            'option'        =>   't'
        ]);

        $this->loadRoutes();
        $this->setWidgetComposer($widget);
	}


	public function register()
	{
		$this->publishMigrations()->loadViewsConfiguration()->registerOtherProviders();

	}



    private function loadViewsConfiguration()
    {
        $this->loadViewsFrom(__DIR__ . '/../Resources/Views/', 'PackageTest');
        return $this;
    }


    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../../migrations/' => base_path('database/migrations'),
        ]);
        return $this;
    }

    /**
     * Load the Routes File
     * @return $this
     */

    private function loadRoutes()
    {

        include __DIR__.'/../Http/routes.php';
        return $this;
    }

    private function loadControllersConfiguration()
    {

        $this->publishes([
           __DIR__.'/../Http/Controllers' => base_path('app/Http/Controllers')
        ]);

        return $this;
    }


    private function setWidgetComposer($widget)
    {
        View::composer('dashboard.dashboard', function ($view) use ($widget){
            $view->with('widget', $widget);
        });
        return $this;
    }

    private function registerOtherProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
        return $this;
    }




}
