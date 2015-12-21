<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class DepositsController extends Controller {
	
	public function index()
	{
		if(Sentinel::hasAccess('depositos.view')){
			return view('contabilidad::Deposits.index');
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	}
	
}