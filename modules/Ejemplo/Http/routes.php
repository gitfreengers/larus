<?php

Route::group(['namespace' => 'Modules\Ejemplo\Http\Controllers'], function()
{
	
	Route::resource('ejemplo', 'EjemploController');
	Route::get('ejemplo/{todo}/delete/', 'EjemploController@delete');
});