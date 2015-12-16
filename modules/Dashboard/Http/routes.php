<?php





Route::group(['prefix' => 'dashboard','namespace' => 'Modules\Dashboard\Http\Controllers','middleware'=>'authSentinel'], function()
{
	Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
});