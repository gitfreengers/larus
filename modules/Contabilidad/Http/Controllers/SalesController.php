<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Sales;

class SalesController extends Controller {
	
	public function index()
	{
		$sales = Sales::all();
		
		return view('contabilidad::Sales.index', compact('sales'));
	}
	
}