<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;
use Pingpong\Modules\Routing\Controller;
use Modules\User\Entities\User;

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
		$ventasPendientes = Sales::whereRaw('ammount_applied < ammount')->get();
		$items['items'] = $ventasPendientes; 
		return response()->json($items);
	}
		
}