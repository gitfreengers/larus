<?php namespace Modules\Dashboard\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class DashboardController extends Controller {

	public function index()
	{
		$widgets = app('app.widgets');
		return view('dashboard::index')->with('widgets', $widgets->getWidgets('demo'));
	}
}