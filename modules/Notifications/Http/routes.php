<?php

Route::group(['namespace' => 'Modules\Notifications\Http\Controllers','middleware'=>'authSentinel'], function()
{



	Route::get('loadJsModal/{id}',['as'=>'notifications.loadJsModal', 'uses'=>'NotificationsController@loadJsModal']);
	Route::get('delete/{id}',['as'=>'notifications.delete', 'uses'=>'NotificationsController@delete']);

	Route::get('my-notifications','NotificationsController@meNotifications');
	Route::resource('notifications','NotificationsController');

});