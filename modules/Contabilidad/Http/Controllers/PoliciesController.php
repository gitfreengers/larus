<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Place;
use Carbon\Carbon;

class PoliciesController extends Controller {
	
	public function index()
	{
		$items = Place::all(['clave','nombre']);
		$plazas = array();
		$fechaAyer = Carbon::now()->subDay()->format('Y/m/d');
		
		
		$plazas[''] = "Seleccione...";
		foreach ($items as $data)
		{
			$plazas[$data->clave] = $data->nombre;
		}
		return view('contabilidad::Policies.form', compact('plazas', 'fechaAyer'));
	}
	
}