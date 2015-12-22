<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Modules\User\Entities\User;

use Modules\Contabilidad\Http\Requests\DepositoReferenciasRequest;
use Modules\Contabilidad\Http\Requests\DepositoRequest;
use Modules\Contabilidad\Entities\Deposito;
use Modules\Contabilidad\Entities\DepositoAplicacion;
use Modules\Contabilidad\Entities\Sales;

class DepositsController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::hasAccess('depositos.view')){
			//$deposito = new Deposito();
			$deposito = Deposito::find(1);
			$deposito->load('depositosaplicados', 'depositosaplicados.venta');
			return view('contabilidad::Deposits.index', compact('deposito'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	}
	
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Sentinel::hasAccess('depositos.view')){
			$deposito = new Deposito();
			return view('contabilidad::Deposits.index', compact('deposito'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	
	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(DepositoRequest $request)
	{
		$deposito = new Deposito();
		$deposito->fill($request->all());
		$user = User::find($this->user_auth->id);
		$deposito->usuario_id = $user->id;
		$deposito->save();
		flash()->success('El deposito ha sido creado, ingrese referencias de venta.');
		
		return view('contabilidad::Deposits.index', compact('deposito'));
	}	
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function guardarReferencias(DepositoReferenciasRequest $request)
	{
		$deposito = Deposito::find($request->deposito_id);
		$referencias = json_decode($request->referencias);
		foreach($referencias as $key=>$value) {
			$ventas = Sales::find($value->id);
			if ($value->isNew){
				$depositoAplicacion = new DepositoAplicacion([
					'venta_id' => $ventas->id,
					'deposito_id' => $deposito->id,
					'usuario_id' => $this->user_auth->id,
					'cantidad' => $value->monto,
				]);
				$depositoAplicacion->save();				
			}
		}
		
		flash()->success('Las referencias de venta se han almacenado correctamente.');
	
		return view('contabilidad::Deposits.index', compact('deposito'));
	}
}