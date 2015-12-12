<?php namespace Modules\Tasks\Http\Controllers;

use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Roles\Entities\Rol;
use Modules\Tasks\Entities\Alert;
use Modules\Tasks\Entities\Status;
use Modules\Tasks\Entities\Task;
use Modules\Tasks\Entities\Note;
use Modules\Tasks\Http\Requests\TasksRequest;
use Modules\User\Entities\User;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Http\Request;


class TasksController extends Controller {

	protected $model;
	protected $user_auth;

	public function __construct(Task $model){
		$this->model = $model;
		$this->user_auth = Sentinel::getUser();
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function index(){
		if(Sentinel::hasAccess('task.view')) {
			$tasks = $this->model->all();
			return view('tasks::index', compact('tasks', $tasks));
		}
		alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
		return back();

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){
		if(Sentinel::hasAccess('task.create')) {
			$users = User::all();
			$roles = Rol::all();
			return view('tasks::create', compact('users', 'roles'));
		}

		alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
		return back();
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(TasksRequest $request){
		$fields = $request->only('flow_id','role_id','name','start_date','due_date','description','status');

		$fields['role_id'] = ($request->has('user_id'))? null : $request->get('role_id');
		$fields['flow_id'] = ($request->has('flow_id'))? $request->get('flow_id') : 1;

		$task = $this->model->create($fields);
		if($request->has('user_id')){
			$task->addUser($request->get('user_id'));
		}

		if($request->has('role_id')){
			$task->addRole($request->get('role_id'));
		}


		flash()->success('La tarea ha sido creada.');
		return redirect()->to('tasks');
	}
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id){
		if(Sentinel::hasAccess('task.update')) {
			$task = $this->model->find($id);
			$users = User::all();
			$roles = Rol::all();
			return view('tasks::update', compact('task', 'users', 'roles'));
		}
		alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
		return back();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request){

		$fields = $request->only('role_id','name','start_date','due_date','description','status_id');

		$fields['role_id'] = ($request->has('user_id'))? null : $request->get('role_id');

		$task = $this->model->find($id);
		if($request->has('user_id')){
			$task->addUser($request->get('user_id'));
		}

		if($request->has('role_id')){
			$task->addRole($request->get('role_id'));
		}

		$task->fill($fields);
		$task->save();


		flash()->success('La tarea ha sido actualizada.');
		return redirect()->to('tasks');
	}

	/**
	 * @return \Illuminate\View\View
	 */
	public function mytasks(){
		$user = User::find($this->user_auth->id);
		$mytasks    = $user->tasks()->nodone()->get();
		$completedtasks = $user->tasks()->done()->get();
		return view('tasks::my-task',compact('mytasks','completedtasks'));
	}

	public function showtask($id){
		$mytask = $this->model->with('notes')->findOrFail($id);
		foreach($mytask['notes'] as $task) {
			array_add($mytask['users'], 'name', $task->users);
		}
		return response()->json(['data'=> $mytask]);
	}

	public function savenote(Request $request){
		$fields = $request->all();
		if(strcmp($request->get('type'),"note") == 0){
			if(!empty($request->get('comment'))){
				$note = Note::create($fields);
				$note->users()->attach($this->user_auth->id);
				return response()->json(['success'=> true]);
			}
		}else{
			$task = $this->model->find($request->get('task_id'));
			$now = Carbon::now();
			$task->user_id_done =  $this->user_auth->id;
			$task->done_date = $now;
			$task->status = 'done';
			$task->save();
			return response()->json(['success'=> true]);
		}

	}


	public function destroy($id){
		if(Sentinel::hasAccess('task.delete')) {
			$this->model->destroy($id);
		}else{
			return response()->json(['error'=>'No tiene permisos para acceder a esta area.'],401);
		}


	}
}