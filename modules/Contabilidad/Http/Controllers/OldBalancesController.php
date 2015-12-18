<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\PaymentMethod;
use Modules\Contabilidad\Entities\Place;

class OldBalancesController extends Controller {
	
	public function index()
	{
		$payment_methods = PaymentMethod::all();
		$plazas = '';// Place::all();
		//dd($plazas);
		return view('contabilidad::OldBalance.form', compact("payment_methods", "plazas"));
	}
	
}