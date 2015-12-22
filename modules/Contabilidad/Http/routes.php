<?php

Route::group(['prefix' => 'contabilidad', 'namespace' => 'Modules\Contabilidad\Http\Controllers'], function()
{
	Route::get('obtenerPorPlaza',['as'=>'locacionesPlaza', 'uses'=>'OldBalancesController@getByPlaza']);
	
	Route::resource('ventas', 'SalesController');
	Route::resource('antiguedad', 'OldBalancesController');
	Route::resource('polizas', 'PoliciesController');
	Route::resource('pendientes', 'EarringsController');
	Route::resource('cancelaciones', 'CancelController'); 
	
	Route::resource('depositos', 'DepositsController'); 
	Route::get('obtenerVentas',['as'=>'contabilidad.depositos.obtenerVentas', 'uses'=>'SalesController@obtenerVentasPendientes']);

	Route::post('guardarReferencias',['as'=>'contabilidad.depositos.guardarReferencias', 'uses'=>'DepositsController@guardarReferencias']);
	Route::get('obtenerDepositos',['as'=>'contabilidad.depositos.obtenerDepositos', 'uses'=>'DepositsController@obtenerDepositos']);
});