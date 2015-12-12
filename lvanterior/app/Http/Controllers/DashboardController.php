<?php namespace App\Http\Controllers;

use App\Http\Requests;


class DashboardController extends Controller
{

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
      return view('dashboard.dashboard');
    }

}