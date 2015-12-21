<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Place;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class CancelController extends Controller {
	
public function index()
	{
		if(Sentinel::hasAccess('cancelaciones.view')){
			$plazas = Place::plazasArray();
			return view('contabilidad::Cancel.index', compact("plazas"));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
		
	}
	
}