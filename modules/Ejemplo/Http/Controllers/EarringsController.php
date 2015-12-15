<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class EarringsController extends Controller {
	
	public function index()
	{
		return view('ejemplo::Earrings.index');
	}
	
}