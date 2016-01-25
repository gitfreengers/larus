<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Place;
use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class PoliciesController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::check()){
			if(Sentinel::hasAccess('polizas.view')){
				$fechaAyer = Carbon::now()->subDay()->format('Y/m/d');
				
				$plazas = Place::plazasArray($this->user_auth->id);
				return view('contabilidad::Policies.form', compact('plazas', 'fechaAyer'));
			}else{
				alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
				return back();
			}		
		}else{
			return redirect('login');
		}
		
	}
	
}