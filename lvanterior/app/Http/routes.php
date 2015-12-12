<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::post('login', 'AuthSentinelController@processLogin');
Route::get('logout', 'AuthSentinelController@logout');
/** login  */
Route::group(['middleware'=>'checkSentinel'], function(){
    Route::get('login', 'AuthSentinelController@login');
});

Route::group(['middleware'=>'authSentinel'], function(){
    /** Dashaboard */
    Route::get('/', 'DashboardController@index');
    /** Users */
    Route::resource('users','UsersController');
    /** Roles */
    Route::resource('roles','RolesController');
    /** Permissions */
    Route::resource('permissions','PermissionsController');
    /** Tasks */
    Route::get('tasks/{id}/remove',['as'=>'tasks.remove', 'uses'=> 'TasksController@remove']);
    Route::get('tasks/{id}/complete',['as'=>'tasks.complete', 'uses'=> 'TasksController@complete']);
    Route::get('tasks/tasks',['as'=>'tasks.getindex', 'uses'=> 'TasksController@getTasks']);
    Route::resource('tasks','TasksController');
    /** Alerts */
    Route::resource('alerts','AlertsController');
    /** Notifications */
    Route::get('notifications/notifications',['as'=>'notifications.getindex', 'uses'=> 'NotificationsController@getNotifications']);
    Route::post('notifications/delete/{array_id}',['as'=>'notifications.getdelete', 'uses'=> 'NotificationsController@getDelete']);
    Route::resource('notifications','NotificationsController');

});














