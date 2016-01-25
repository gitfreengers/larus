<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;
use Modules\User\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Contabilidad\Http\Requests\VentasPendientesRequest;

class SalesController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::check()){
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
		
		}else{
			return redirect('login');
		}
		
	}
	
	public function obtenerVentasPendientes(VentasPendientesRequest $request) 
	{
		$usuario = User::find($this->user_auth->id);
		$oficinas = array();
		foreach ($usuario->plazas as $plazas){
			array_push($oficinas, $plazas->Oficina);
		}
		DB::enableQueryLog();
		
		$ventasPendientes = DB::table('contabilidad_sales')
							->select('*',  DB::raw('SUM(ammount) as ammount, SUM(ammount_applied) as ammount_applied '))
							->whereRaw('credit_debit = ? and reference = ? ', ['credit', $request->get('referencia')])
							//->whereRaw('ammount_applied < ammount and credit_debit = ? and reference = ? ', ['credit', $request->get('referencia')])
							//->where(function ($query) use ($oficinas) {
							//	$query->whereIn('op_location', $oficinas)->orWhere(function ($query) use ($oficinas) {
							//		$query->whereIn('cl_location', $oficinas);
							//	}); 
							//})
							->groupBy('reference')
							->get();
		$items['items'] = $ventasPendientes; 
		return response()->json($items);
	}
		
}