<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;
use Pingpong\Modules\Routing\Controller;

class SalesController extends Controller {
	
	public function index()
	{
		if(Sentinel::hasAccess('ventas.view')) {
			$salesLogs = SalesLog::all();
			return view('contabilidad::Sales.index', compact('salesLogs'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
		
	}
	
	public function obtenerVentasPendientes() 
	{
		$ventasPendientes = Sales::where('ammount_applied', 0);//('saldo', $request->get('plaza'))->get();
		$items['items'] = $ventasPendientes; 
		return response()->json($items);
	}
		
}