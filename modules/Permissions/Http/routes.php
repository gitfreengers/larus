<?php

Route::group(['namespace' => 'Modules\Permissions\Http\Controllers','middleware'=>'authSentinel'], function()
{
	Route::resource('permissions','PermissionsController');
});