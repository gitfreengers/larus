<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class CancelController extends Controller {
	
public function index()
	{
		return view('contabilidad::Cancel.index');
	}
	
}