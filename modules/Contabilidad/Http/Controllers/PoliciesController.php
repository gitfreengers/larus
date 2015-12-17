<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class PoliciesController extends Controller {
	
	public function index()
	{
		return view('contabilidad::Policies.form');
	}
	
}