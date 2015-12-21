<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Place;
use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class PoliciesController extends Controller {
	
	public function index()
	{
		
		if(Sentinel::hasAccess('polizas.view')){
			$fechaAyer = Carbon::now()->subDay()->format('Y/m/d');
			$plazas = Place::plazasArray();
			return view('contabilidad::Policies.form', compact('plazas', 'fechaAyer'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
		
	}
	
}