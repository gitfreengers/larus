<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Place;

class CancelController extends Controller {
	
public function index()
	{
		$items = Place::all(['clave','nombre']);
		
		$plazas = array();
		
		$plazas[''] = "Seleccione...";
		foreach ($items as $data)
		{
			$plazas[$data->clave] = $data->nombre;
		}
		return view('contabilidad::Cancel.index', compact("plazas"));
	}
	
}