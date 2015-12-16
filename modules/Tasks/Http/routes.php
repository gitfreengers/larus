<?php

Route::group(['namespace' => 'Modules\Tasks\Http\Controllers','middleware'=>'authSentinel'], function()
{
	Route::post('savenote',['as'=>'tasks.savenote','uses'=>'TasksController@savenote']);
	Route::get('my-tasks','TasksController@mytasks');
	Route::get('showtask/{id}',['as'=>'tasks.showtask', 'uses'=>'TasksController@showtask']);
	Route::resource('tasks','TasksController');
});