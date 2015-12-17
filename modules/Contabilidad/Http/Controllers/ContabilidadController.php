<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class ContabilidadController extends Controller {
	
	public function index()
	{
		return view('contabilidad::index');
	}
	
}