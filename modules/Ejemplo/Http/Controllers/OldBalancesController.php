<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class OldBalancesController extends Controller {
	
	public function index()
	{
		return view('ejemplo::OldBalance.form');
	}
	
}