<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class OldBalancesController extends Controller {
	
	public function index()
	{
		return view('contabilidad::OldBalance.form');
	}
	
}