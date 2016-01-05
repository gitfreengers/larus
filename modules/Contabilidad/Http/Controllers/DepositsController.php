<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Pingpong\Modules\Routing\Controller;

use Modules\User\Entities\User;

use Modules\Contabilidad\Entities\Deposito;
use Modules\Contabilidad\Entities\DepositoAplicacion;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Http\Requests\DepositoReferenciasRequest;
use Modules\Contabilidad\Http\Requests\DepositoRequest;
use Modules\Contabilidad\Entities\Cuentas;

class DepositsController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::hasAccess('depositos.view')){
			$deposito = new Deposito();
			$cuentas = Cuentas::cuentasArray($this->user_auth->id);
			return view('contabilidad::Deposits.index', compact('deposito', 'cuentas'));
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
		$deposito->banco = explode("|", $deposito->banco)[0];
		$user = User::find($this->user_auth->id);
		$deposito->usuario_id = $user->id;
		$deposito->id = 0;
		
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
		$depositoRef = json_decode($request->deposito);
		$deposito = new Deposito([
			'banco' => $depositoRef->{'banco'},
			'fecha' => $depositoRef->{'fecha'},
			'monto' => $depositoRef->{'monto'},
			'moneda' => $depositoRef->{'moneda'},
			'cuenta_contable' => $depositoRef->{'cuenta_contable'},
			'complementaria' => $depositoRef->{'complementaria'},
			'usuario_id' => $depositoRef->{'usuario_id'},
			'estatus' => 0
		]);
		$deposito->save();
		$referencias = json_decode($request->referencias);
		foreach($referencias as $key=>$value) {
			if ($value->isNew){
				$ventas = Sales::where('reference', $value->id)->where('credit_debit','credit')->get();
				$montoAplicar = $value->monto;
				
				foreach ($ventas as $venta){
					
					//si el monto de la venta es mayor al monto aplicado 
					//entonces aplicamos
					if ($venta->ammount > $venta->ammount_applied){
						
						$montoRestante = ($venta->ammount - $venta->ammount_applied);
						
						// si el monto a aplicar es mayor al monto aplicado descontamos del monto a aplicar
						if ($montoAplicar > $montoRestante ){
							$monto = $montoRestante;
							$montoAplicar = $montoAplicar - $montoRestante;
						} else {
							$monto = $montoAplicar;
							$montoAplicar = 0;
						}
						
						if ($monto > 0){
							$depositoAplicacion = new DepositoAplicacion([
								'venta_id' => $venta->id,
								'deposito_id' => $deposito->id,
								'usuario_id' => $this->user_auth->id,
								'cantidad' => $monto,
							]);
							$venta->ammount_applied = $venta->ammount_applied + $monto;
							
							$depositoAplicacion->save();
						}
						$venta->update();
					}					
				}
			}
		}
		flash()->success('Las referencias de venta se han almacenado correctamente.');
		
		$deposito = new Deposito();
		return view('contabilidad::Deposits.index', compact('deposito'));
	}
	
}