<?php
Route::group(['namespace' => 'Modules\Roles\Http\Controllers','middleware'=>'authSentinel'], function()
{
	Route::resource('roles','RolesController');
});