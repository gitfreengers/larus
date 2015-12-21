<?php

Route::group(['prefix' => 'contabilidad', 'namespace' => 'Modules\Contabilidad\Http\Controllers'], function()
{
	//Route::get('/', 'ContabilidadController@index');
	
	Route::resource('ventas', 'SalesController');
	Route::resource('antiguedad', 'OldBalancesController');
	Route::resource('polizas', 'PoliciesController');
	Route::resource('pendientes', 'EarringsController');
	Route::resource('depositos', 'DepositsController'); 
	Route::resource('cancelaciones', 'CancelController'); 
	Route::get('obtenerPorPlaza',['as'=>'locacionesPlaza', 'uses'=>'OldBalancesController@getByPlaza']);
	
});