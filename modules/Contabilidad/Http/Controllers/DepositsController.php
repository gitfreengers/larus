<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DepositsController extends Controller {
	
	public function index()
	{
		return view('contabilidad::Deposits.index');
	}
	
}