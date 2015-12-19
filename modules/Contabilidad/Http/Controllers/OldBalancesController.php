<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\PaymentMethod;
use Modules\Contabilidad\Entities\Place;
use Carbon\Carbon;
use Modules\Contabilidad\Entities\LocalizationExecutive;
use Modules\Contabilidad\Http\Requests\LocationsExecutiveRequest;

class OldBalancesController extends Controller {
	
	public function index()
	{
		$payment_methods = PaymentMethod::all();
		$items = Place::all(['Clave','Nombre']);
		$fechaActual = Carbon::now()->format('Y/m/d');
		
		$plazas = array();
		
		$plazas[''] = "Seleccione...";
		foreach ($items as $data)
		{
			$plazas[$data->Clave] = $data->Nombre;
		}
		
		return view('contabilidad::OldBalance.form', compact("payment_methods", "plazas", "fechaActual"));
	}
	
	
	public function getByPlaza(LocationsExecutiveRequest $request){
		$localizationExecutives = LocalizationExecutive::where('numero_plaza', $request->get('plaza'))->get();
		return response()->json($localizationExecutives);
	}
}