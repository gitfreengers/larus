<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Notification;
use App\Role;
use App\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\NotificationRequest;
use Illuminate\Support\Facades\Mail;


class NotificationsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(){

        if(Sentinel::hasAccess('notification.view')){
            $notifications = Notification::all();

            return view('notifications.notifications.notifications',compact('notifications'));
        }else{
            return back()
                ->withErrors(['NoAccess'=>'No tiene permisos para acceder a esta area.']);
        }
    }
    /**
     * @return $this|\Illuminate\View\View
     */
	public function getNotifications()
	{
		//
        $user = Sentinel::getUser();
        $user_id = $user->id;
        $array_notification = [];

        // notifications
        $notifications = Notification::where('user_id', '=', $user->id)
            ->orwhere('role_id','=', $user->roles[0]->id)->get();

        foreach($notifications as $notification){
            if(is_null($notification->status)){
                array_push($array_notification,$notification);

            }elseif(!in_array($user->id, unserialize($notification->status))){
                array_push($array_notification,$notification);

            }

        }

        return view('notifications.notifications.index',compact('array_notification','user_id'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        if(Sentinel::hasAccess('notification.create')) {
            $users = User::select(
                DB::raw("CONCAT(first_name ,' ',  last_name) AS full_name, id")
            )->get();
            $roles = Role::all();

            return view('notifications.notifications.create', compact('users', 'roles'));
        }else{
            return back()
                ->withErrors(['NoAccess'=>'No tiene permisos para acceder a esta area.']);
        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, NotificationRequest $notificationRequest)
	{

		//
        $fields = $request->except(['optionsRadios','email']);

        if($request->get('email') ==  1){
            if(strcmp($request->get('optionsRadios'),"users" ) == 0 ){
                $user_id = $request->get('user_id');
                $user = User::findOrFail($user_id);

                Mail::send('emails.notification',['user' => $user,'fields'=> $fields],
                    function ($m) use ($user,$fields){
                        $m->to($user->email)
                            ->subject('Usted tiene una nueva notificación '.$fields['title']);
                });
            }else{
                $role_id = $request->get('role_id');
                $role = Sentinel::findRoleById($role_id);
                    $users = $role->users()->with('roles')->get();

                foreach($users as $user){
                    Mail::send('emails.notification',['user' => $user,'fields'=> $fields],
                        function ($m) use ($user,$fields){
                            $m->to($user->email)
                                ->subject('Usted tiene una nueva notificación '.$fields['title']);
                        });
                }
            }
        }


         $notification = Notification::create($fields);

        return \Redirect::to('notifications')
            ->withSuccess('La notificación se ha sido añadido.');


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = Sentinel::getUser();
        $notification = Notification::find($id);

        if(is_null($notification->read)){
            $array_read[] = $user->id;
        }else{
            $array_read = unserialize($notification->read);
            if(!in_array($user->id, $array_read)){
                array_push($array_read, $user->id);
            }
        }
        $notification->read = serialize($array_read);
        $notification->save();
        return view('notifications.notifications.show', compact('notification'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        if(Sentinel::hasAccess('notification.update')) {
            $notification = Notification::find($id);

            $users = User::select(
                DB::raw("CONCAT(first_name ,' ',  last_name) AS full_name, id")
            )->get();
            $roles = Role::all();

            return view('notifications.notifications.update', compact('notification','users','roles'));
        }else{
            return back()
                ->withErrors(['NoAccess'=>'No tiene permisos para acceder a esta area.']);
        }
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request, NotificationRequest $notificationRequest)
	{
		//
        $fields = $request->except('optionsRadios','email');

        $notification = Notification::find($id);

        if(!isset($fields['user_id'])){
            $fields['user_id'] = NULL;
        }
        if(!isset($fields['role_id'])){
            $fields['role_id'] = NULL;
        }

        if($request->get('email') ==  1) {
            if (strcmp($request->get('optionsRadios'), "users") == 0) {
                $user_id = $request->get('user_id');
                $user = User::findOrFail($user_id);

                Mail::send('emails.notification', ['user' => $user, 'fields' => $fields],
                    function ($m) use ($user, $fields) {
                        $m->to($user->email)
                            ->subject('Usted tiene una nueva notificación ' . $fields['title']);
                    });
            } else {
                $role_id = $request->get('role_id');
                $role = Sentinel::findRoleById($role_id);
                $users = $role->users()->with('roles')->get();

                foreach ($users as $user) {
                    Mail::send('emails.notification', ['user' => $user, 'fields' => $fields],
                        function ($m) use ($user, $fields) {
                            $m->to($user->email)
                                ->subject('Usted tiene una nueva notificación ' . $fields['title']);
                        });
                }
            }
        }

        $notification->fill($fields);
        $notification->save();
        return \Redirect::to('notifications')
            ->withSuccess('La notificación se ha sido actualizado.');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDelete($array_id)
	{
		//
        $array = explode(",", $array_id);
        Notification::destroy($array);
        return 1;

	}


    public function destroy($id){

        $notification = Notification::destroy($id);

        if($notification > 0 ){
            $affectedRows = 1;
        }
        return $affectedRows;
    }

}
