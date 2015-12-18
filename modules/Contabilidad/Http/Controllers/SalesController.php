<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Modules\Contabilidad\Entities\Sales;
use Modules\Contabilidad\Entities\SalesLog;

class SalesController extends Controller {
	
	public function index()
	{
		$salesLogs = SalesLog::all();
		
		return view('contabilidad::Sales.index', compact('salesLogs'));
	}
	
}