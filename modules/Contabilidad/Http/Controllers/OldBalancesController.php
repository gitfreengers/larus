<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\PaymentMethod;
use Modules\Contabilidad\Entities\Place;
use Carbon\Carbon;
use Modules\Contabilidad\Entities\LocalizationExecutive;
use Modules\Contabilidad\Http\Requests\LocationsExecutiveRequest;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class OldBalancesController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::check()){
			if(Sentinel::hasAccess('antiguedad.view')){
				$fechaActual = Carbon::now()->format('Y/m/d');
				$payment_methods = PaymentMethod::all();
				$plazas = Place::plazasArray($this->user_auth->id);
				return view('contabilidad::OldBalance.form', compact("payment_methods", "plazas", "fechaActual"));
			}else{
				alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
				return back();
			}		
		}else{
			return redirect('login');
		}
	}
	
	
	public function getByPlaza(LocationsExecutiveRequest $request){
		$localizationExecutives = LocalizationExecutive::where('numero_plaza', $request->get('plaza'))->get();
		return response()->json($localizationExecutives);
	}
}