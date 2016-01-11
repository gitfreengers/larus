<?php namespace Modules\Contabilidad\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Modules\Contabilidad\Entities\Sales;
use Illuminate\Support\Facades\DB;
use Modules\Contabilidad\Entities\DepositoAplicacion;

class UpdateSalesCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'larus:updateSales';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		Log::info('Iniciando proceso de actualizacion de referencia de ventas');
		$sales = Sales::where('transaction_id', '-1')->get();
		foreach ($sales as $sale){
			$ventasPorAplicar = DB::table('contabilidad_sales')
							->select('*')
							->whereRaw('credit_debit = ? and reference = ? ', ['credit', $sale->reference])
							->where('transaction_id', '<>', '-1')
							->groupBy('reference')
							->get();
							
			if (count($ventasPorAplicar) > 0){// se encontraron referencias de venta nuevas
				foreach($ventasPorAplicar as $ventaPorAplicar){
					$depositoAplicacionAnterior = DepositoAplicacion::where('venta_id', $sale->id)->get();
					foreach ($depositoAplicacionAnterior as $depositoAplicacion){
						echo ($depositoAplicacion->cantidad.' '.$depositoAplicacion->deposito_id.' -- '.$ventaPorAplicar->ammount .'-- '.$ventaPorAplicar->ammount_applied.'-------');
						
						if ($depositoAplicacion->estatus == 1){
							$deposito =  new DepositoAplicacion([
									'deposito_id' => $depositoAplicacion->deposito_id,
									'venta_id' => $ventaPorAplicar->id,
									'estatus' => $depositoAplicacion->estatus,
									'usuario_id' => $depositoAplicacion->usuario_id,
									'cantidad' => $depositoAplicacion->cantidad
							]);
							$ventaPorAplicar->ammount_applied = $depositoAplicacion->cantidad + ($ventaPorAplicar->ammount - $ventaPorAplicar->ammount_applied);
						}else{
							if (abs($depositoAplicacion->cantidad) >= ($ventaPorAplicar->ammount - $ventaPorAplicar->ammount_applied)){
								$ventaPorAplicar->ammount_applied = $depositoAplicacion->ammount; 
								$depositoAplicacion->cantidad = $depositoAplicacion->cantidad - ($ventaPorAplicar->ammount - $ventaPorAplicar->ammount_applied);
							}else{
								$ventaPorAplicar->ammount_applied = ($ventaPorAplicar->ammount - $ventaPorAplicar->ammount_applied) - ($depositoAplicacion->cantidad);
								$depositoAplicacion->cantidad = 0;
							}
							$deposito =  new DepositoAplicacion([
									'deposito_id' => $depositoAplicacion->deposito_id,
									'venta_id' => $ventaPorAplicar->id,
									'estatus' => $depositoAplicacion->estatus,
									'usuario_id' => $depositoAplicacion->usuario_id,
									'cantidad' => (-1 * ($ventaPorAplicar->ammount_applied - $ventaPorAplicar->ammount))
							]);
							
						}
						
						$deposito->save();
						$$ventaPorAplicar->update();
						$depositoAplicacion->delete();
					}					
				}
			}
		}
		Log::info('Finalizando proceso de actualizacion de referencia de ventas');
	}

}
