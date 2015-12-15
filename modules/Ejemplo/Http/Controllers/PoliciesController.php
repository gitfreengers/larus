<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PoliciesController extends Controller {
	
	public function index()
	{
		return view('ejemplo::Policies.form');
	}
	
}