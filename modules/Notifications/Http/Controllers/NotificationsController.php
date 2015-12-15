<?php namespace Modules\Notifications\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Notifications\Entities\Notification;
use Modules\Roles\Entities\Rol;
use Modules\User\Entities\User;
use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

class NotificationsController extends Controller {

	protected $auth;

	public function __construct(){
		$this->auth = Sentinel::getUser();
	}

	public function index(){
		$notifications = Notification::all();
		return view('notifications::index',compact('notifications'));
	}
	public function create(){
		$users = User::all();
		$roles = Rol::all();
		return view('notifications::create',compact('users','roles'));
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		$notification = Notification::find($id);
		$users = User::all();
		$roles = Rol::all();
		return view('notifications::update', compact('notification','users','roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request){
		//
		$fields = $request->except(['optionsRadios','email']);
		$fields['icon'] = "fa-envelope-o";
		$notification = Notification::create($fields);

		if($request->has('user_id')){
			$notification->addUser($request->get('user_id'));
		}
		if($request->has('role_id')){
			$notification->addRole($request->get('role_id'));
		}

		if($request->get('email') ==  1){
			if(strcmp($request->get('optionsRadios'),"users" ) == 0 ){
				$user = User::findOrFail($request->get('user_id'));
				// send email
				$notification->smail($user, $fields);
			}else{
				$role = Sentinel::findRoleById($request->get('role_id'));
				$users = $role->users()->with('roles')->get();
				// send email
				foreach($users as $user){
					$notification->smail($user, $fields);
				}
			}
		}

		flash()->success('La notificación ha sido creada.');
		return redirect()->to('notifications');

	}
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//
		$fields = $request->except('optionsRadios','email');
		$fields['icon'] = "fa-envelope-o";
		$user_id = $request->get('user_id');
		$role_id = $request->get('role_id');

		$notification = Notification::find($id);

		if($request->has('user_id')){
			$notification->addUser($request->get('user_id'));
		}
		if($request->has('role_id')){
			$notification->addRole($request->get('role_id'));
		}

		if($request->get('email') ==  1) {
			if (strcmp($request->get('optionsRadios'), "users") == 0) {
				$user = User::findOrFail($user_id);
				// send email
				$notification->smail($user,$fields);

			} else {
				$role = Sentinel::findRoleById($role_id);
				$users = $role->users()->with('roles')->get();
				//send email
				foreach ($users as $user) {
					$notification->smail($user,$fields);

				}
			}
		}

		$notification->fill($fields);
		$notification->save();
		flash()->success('La notificación ha sido actualizada.');
		return redirect()->to('notifications');

	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function meNotifications(){
		$user = User::find($this->auth->id);
		$noread = $user->notifications()->noread()->get();
		$read = $user->notifications()->read()->get();
		return view('notifications::my-notifications',compact('noread','read'));
	}


	public function loadJsModal($id){
		$notification = Notification::find($id);
		$notification->addRead($this->auth->id);
		return response()->json([
			'success' => true,
			'view'=> view('notifications::modals.modal-body',compact('notification'))->render()
		]);
	}

	public function destroy($id){
		Notification::destroy($id);
	}

	public function delete($id){
		$notification = Notification::find($id);
		$notification->addActive($this->auth->id);
		return response()->json([
			'success' => true
		]);
	}

}