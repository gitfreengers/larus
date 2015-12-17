<?php

Route::group(['namespace' => 'Modules\Ejemplo\Http\Controllers'], function()
{
	
	Route::resource('ejemplo', 'EjemploController');
	Route::get('ejemplo/{todo}/delete/', 'EjemploController@delete');
	
	Route::resource('sales', 'SalesController');
	Route::resource('oldBalance', 'OldBalancesController');
	Route::resource('policies', 'PoliciesController');
	Route::resource('earrings', 'EarringsController');
	Route::resource('deposits', 'DepositsController');
});