<?php namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {
	
	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [ 
		'App\Console\Commands\Inspire',
		'Modules\Contabilidad\Console\SalesReadCommand',
		'Modules\Contabilidad\Console\UpdateSalesCommand'
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param \Illuminate\Console\Scheduling\Schedule $schedule        	
	 * @return void
	 */
	protected function schedule(Schedule $schedule) {
		//$schedule->command ( 'inspire' )->hourly ();
		
		//@todo solo cambio para pruebas debe de quedarse en hourly()
		$schedule->command('larus:salesRead')->cron('*/1 * * * *');
		
		//@todo solo cambio para pruebas debe de quedarse en cada 2 horas()
		$schedule->command('larus:salesRead')->cron('*/30 * * * *');
	}

}
