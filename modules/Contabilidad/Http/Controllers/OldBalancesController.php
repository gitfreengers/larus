<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\PaymentMethod;

class OldBalancesController extends Controller {
	
	public function index()
	{
		$payment_methods = PaymentMethod::all();
		return view('contabilidad::OldBalance.form', compact("payment_methods"));
	}
	
}