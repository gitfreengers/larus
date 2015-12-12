<?php namespace App\Http\Controllers;

use App\Alert;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use APP\User;
use App\Role;
use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TasksRequest;

class TasksController extends Controller {

    /**
     * @return \Illuminate\View\View
     */
    public function getTasks(){
        //
        $array_task = [];

        $user = Sentinel::getUser();
        $user_id = $user->id;
        $task_paginate = Task::paginate(10);
        $now = Carbon::today();


        //tareas
        $tasks = Task::where('user_id', '=', $user->id)
            ->orwhere('role_id','=', $user->roles[0]->id)->get();

        foreach($tasks as $task){
            if(is_null($task->status)){
                array_push($array_task,$task);

            }elseif(!in_array($user->id, unserialize($task->status))){
                array_push($array_task,$task);

            }


        }

        return view('notifications.tasks.index',compact('task_paginate', 'array_task','user_id','now'));

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Sentinel::hasAccess('task.view')){
            $tasks = Task::all();

            return view('notifications.tasks.tasks',compact('tasks'));
        }else{
            return back()
                ->withErrors(['NoAccess'=>'No tiene permisos para acceder a esta area.']);
        }

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

        if(Sentinel::hasAccess('task.create')) {
            $users = User::select(
                DB::raw("CONCAT(first_name ,' ',  last_name) AS full_name, id")
            )->get();
            $roles = Role::all();

            return view('notifications.tasks.create', compact('users', 'roles'));
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
	public function store(Request $request, TasksRequest $tasksRequest)
	{
		//
        $fields = $request->except('optionsRadios');

        list($start,$end) = explode('-',$request->get('date'));
        $start_date = Carbon::createFromTimestamp(strtotime($start));
        $end_date   = Carbon::createFromTimestamp(strtotime($end));

        $fields['start_time'] = $start_date;
        $fields['expire_time'] = $end_date;

        $task_id = Task::create($fields);
        $last_id = $task_id->id;

        $alert_field['task_id'] = $last_id;
        $alert_field['title'] = "La tarea expiro";
        $alert_field['description'] = "El periodo de tiempo de ejecucion de la tarea llego a su limite y no se termino.";
        $alert_field['url'] =  "/tasks/".$last_id;

        Alert::create($alert_field);


        return \Redirect::to('tasks')
            ->withSuccess('La tarea se ha sido añadido.');


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//

        setlocale(LC_TIME, 'es_ES');

        $user = Sentinel::getUser();
        $task = Task::find($id);
        $now = Carbon::now();

        if(empty($task->read)){
            $array_read[] = $user->id;


        }else{
            $array_read = unserialize($task->read);

            if(!in_array($user->id, $array_read)){
                array_push($array_read, $user->id);
            }

        }
        $task->read = serialize($array_read);
        $task->save();

        //verificamos si la tarea esta terminada
        $complete = $task->user_complete_id;


        switch(TRUE){
            case ($complete > 0):
                $btn = "btn-success";
                $disabled = "disabled";
                $txt = "Terminada";
                break;
            case ($task->expire_time < $now):
                $btn = "btn-danger";
                $disabled = "disabled";
                $txt = "Expiro";
                break;
            case (is_null($complete) ):
                $btn = "btn-info";
                $disabled = "";
                $txt = "Completar";
                break;


        }



        $task->start_time  = Carbon::parse($task->start_time)->formatLocalized('%A %d %B %Y %T %p');
        $task->expire_time = Carbon::parse($task->expire_time)->formatLocalized('%A %d %B %Y %T %p');







        return view('notifications.tasks.show', compact('task', 'now','btn','txt','disabled'));


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
        if(Sentinel::hasAccess('task.update')) {
            $task = Task::find($id);

            $users = User::select(
                DB::raw("CONCAT(first_name ,' ',  last_name) AS full_name, id")
            )->get();
            $roles = Role::all();

            $task['date'] = str_replace('-','/',$task->start_time)." - ". str_replace('-','/',$task->expire_time);



            return view('notifications.tasks.update', compact('task','users','roles'));
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
	public function update($id, Request $request)
	{
		//

        $fields = $request->except(['optionsRadios','date']);


        if(!isset($fields['user_id'])){
            $fields['user_id'] = NULL;
        }
        if(!isset($fields['role_id'])){
            $fields['role_id'] = NULL;
        }

        list($start,$end) = explode('-',$request->get('date'));
        $start_date = Carbon::createFromTimestamp(strtotime($start));
        $end_date   = Carbon::createFromTimestamp(strtotime($end));

        $fields['start_time'] = $start_date;
        $fields['expire_time'] = $end_date;


        $task = Task::find($id);

        $task->fill($fields);
        $task->save();
        return \Redirect::to('tasks')
            ->withSuccess('La tarea ha sido actualizado.');




	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//



        $task = Task::destroy($id);

        if($task > 0 ){

            $affectedRows = 1;

        }
        return $affectedRows;
	}

    /**
     * @param $id
     * @return mixed
     */

    public  function remove($id){
        $user = Sentinel::getUser();
        $task = Task::find($id);

        if(is_null($task->status)){
            $array_status[] = $user->id;

        }else{
            $array_status = unserialize($task->status);

            if(!in_array($user->id, $array_status)){
                array_push($array_status, $user->id);

            }

        }


        $task->status = serialize($array_status);
        $task->save();

        return Redirect::to('tasks/tasks')->withSuccess('Tarea Eliminada');

    }

    public function complete($id){
        $user = Sentinel::getUser();
        $task = Task::find($id);
        $now = Carbon::now();

        $task->user_complete_id =  $user->id;
        $task->time_complete = $now;


        if($task->save()){
            // Ponemos alertas leidas, para que no aparescan cuando ya se completo una tarea
            $alerts = Alert::where('task_id', '=', $id)->first();
            if(empty($alerts->alert_display)){
                $array_read[] = $user->id;
            }else{
                $array_read = unserialize($alerts->alert_display);
                if(!in_array($user->id, $array_read)){
                    array_push($array_read, $user->id);
                }
            }
            $alerts->alert_display = serialize($array_read);
            $alerts->save();
            return Redirect::to('tasks/tasks')->withSuccess('Tarea Completada');
        }
    }

}
