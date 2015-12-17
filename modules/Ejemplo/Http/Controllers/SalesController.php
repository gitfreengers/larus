<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Ejemplo\Entities\Sales;

class SalesController extends Controller {
	
	public function index()
	{
		$sales = new Sales();
		
		return view('ejemplo::Sales.index', compact('sales'));
	}
	
}