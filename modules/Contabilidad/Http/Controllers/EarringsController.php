<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class EarringsController extends Controller {
	
	public function index()
	{
		return view('contabilidad::Earrings.index');
	}
	
}