<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class EarringsController extends Controller {
	
	public function index()
	{
		if(Sentinel::hasAccess('pendientes.view')){
			return view('contabilidad::Earrings.index');
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	}
	
}