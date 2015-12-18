<?php

Route::group(['prefix' => 'contabilidad', 'namespace' => 'Modules\Contabilidad\Http\Controllers'], function()
{
	//Route::get('/', 'ContabilidadController@index');
	
	Route::resource('sales', 'SalesController');
	Route::resource('oldBalance', 'OldBalancesController');
	Route::resource('policies', 'PoliciesController');
	Route::resource('earrings', 'EarringsController');
	Route::resource('deposits', 'DepositsController');
});