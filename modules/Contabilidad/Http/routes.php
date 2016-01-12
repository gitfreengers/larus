<?php

Route::group(['prefix' => 'contabilidad', 'namespace' => 'Modules\Contabilidad\Http\Controllers'], function()
{
	Route::get('obtenerPorPlaza',['as'=>'locacionesPlaza', 'uses'=>'OldBalancesController@getByPlaza']);
	
	Route::resource('ventas', 'SalesController');
	Route::get('obtenerVentas',['as'=>'contabilidad.ventas.obtenerVentas', 'uses'=>'SalesController@obtenerVentasPendientes']);
	
	Route::resource('antiguedad', 'OldBalancesController');
	
	Route::resource('polizas', 'PoliciesController');
	
	Route::resource('pendientes', 'EarringsController');

	Route::resource('cancelaciones', 'CancelController'); 
	Route::get('obtenerDepositos',['as'=>'contabilidad.cancelaciones.obtenerDepositos', 'uses'=>'CancelController@obtenerDepositos']);
	
	Route::resource('depositos', 'DepositsController'); 
	Route::post('guardarReferencias',['as'=>'contabilidad.depositos.guardarReferencias', 'uses'=>'DepositsController@guardarReferencias']);
	Route::get('obtenerComban',['as'=>'contabilidad.depositos.obtenerComban', 'uses'=>'DepositsController@obtenerComban']);
	
	Route::resource('cuentas', 'CuentasController');
});
