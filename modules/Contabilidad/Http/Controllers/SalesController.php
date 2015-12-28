<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;
use Modules\User\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::hasAccess('ventas.view')) {
			$usuario = User::find($this->user_auth->id);
			$oficinas = array();
			foreach ($usuario->plazas as $plazas){
				array_push($oficinas, $plazas->Oficina);
			}
			$salesLogs = SalesLog::whereIn('op_location', $oficinas)->orWhere(function ($query) use ($oficinas) {
				$query->whereIn('cl_location', $oficinas);
			})->get();
			return view('contabilidad::Sales.index', compact('salesLogs'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
		
	}
	
	public function obtenerVentasPendientes() 
	{
		$usuario = User::find($this->user_auth->id);
		$oficinas = array();
		foreach ($usuario->plazas as $plazas){
			array_push($oficinas, $plazas->Oficina);
		}
		
		$ventasPendientes = DB::table('sales')
							->select('*',  DB::raw('SUM(ammount) as ammount'))
							->whereRaw('ammount_applied < ammount and credit_debit = ?', ['credit'])
							->whereIn('op_location', $oficinas)->orWhere(function ($query) use ($oficinas) {
								$query->whereIn('cl_location', $oficinas);
							})
							->groupBy('reference')
							->get();
		$items['items'] = $ventasPendientes; 
		return response()->json($items);
	}
		
}