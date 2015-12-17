<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DepositsController extends Controller {
	
	public function index()
	{
		return view('ejemplo::Deposits.index');
	}
	
}