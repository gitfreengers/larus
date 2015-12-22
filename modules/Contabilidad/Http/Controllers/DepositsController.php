<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Http\Requests\DepositoRequest;
use Illuminate\Database\Eloquent\Model;
use Modules\Contabilidad\Entities\Deposito;
use Modules\User\Entities\User;

class DepositsController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::hasAccess('depositos.view')){
			//$deposito = new Deposito();
			$deposito = Deposito::find(2);
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
	
	
}