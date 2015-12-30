<?php namespace Modules\User\Http\Controllers;

use Modules\Roles\Entities\Rol;
use Pingpong\Modules\Routing\Controller;
use Modules\User\Entities\User;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\User\Http\Requests\UserCreateRequest;
use Modules\User\Http\Requests\UserUpdateRequest;
use App\Http\Requests;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Modules\Contabilidad\Entities\Place;


class UserController extends Controller {

	protected $model;

	public function __construct(User $model){
		$this->model = $model;
	}

	public function index(){
		if(Sentinel::hasAccess('user.view')){
			$users = $this->model->all();
			return view('user::index',compact('users'));
		}
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();

	}
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Sentinel::hasAccess('user.create')){
			$roles = Rol::all()->lists('name','slug');
			$plazas = Place::all();
			$place_user = array();
			return view('user::create', compact('roles', 'plazas', 'place_user'));
		}
		alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');

		return back();


	}
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, UserCreateRequest $UserCreateRequest)
	{
		$slug = $request->input('roles');
		$image = $request->file('image');
		//find by slug the role
		$role = Sentinel::findRoleBySlug($slug);
		//create the user
		$time = Str::slug(\Carbon\Carbon::now());

		if(isset($image)){
			$ext = $image->getClientOriginalExtension();
			$name = 'user_'.$time. '.' .$ext;
			$image->move(public_path().'/img/users',$name);
		}

		$input = $request->except(['image']);
		$input['image'] = (isset($image))? $name : 'avatar-larus.jpeg';

		// Register and actived usuer
		$user = Sentinel::registerAndActivate($input);
		$user->roles()->attach($role);

		//agregacion de permisos para plazas por usuario
		$plazas = $request->plazas;
		$user_ = User::find($user->id);
		$user_->plazas()->detach();
		if (count($plazas) > 0){
			foreach ($plazas as $plaza){
				$plaza_e = Place::where('Clave', $plaza)->first();
				$user_->plazas()->attach($plaza_e);
			}
		}
		
		flash()->success('El usuario ha sido añadido.');
		return redirect()->to('users');
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
		if(Sentinel::hasAccess('user.update')){
			// Execute this code if the user has permission
			$users = Sentinel::findById($id);
			$rolUser = $users->roles()->get();
			$roles = Rol::all()->lists('name','slug');
			
			$plazas = Place::all();
			$user = User::find($id);
			$place_user = $user->plazas()->get();
			$plazas = $plazas->diff($place_user);
			
			return view('user::edit',compact('users','roles','rolUser','plazas', 'place_user'));
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
	public function update($id, Request $request, UserUpdateRequest $UserUpdateRequestRequest)
	{
		$input = $request->except(['roles']);
		$image = $request->file('image');
		// find an user
		$user = Sentinel::findById($id);
		$image_old = $user->image;
		$time = Str::slug(\Carbon\Carbon::now());

		//agregacion de permisos para plazas por usuario
		$plazas = $request->plazas;
		$user_ = User::find($id);
		$user_->plazas()->detach();
		if (count($plazas) > 0){
			foreach ($plazas as $plaza){
				$plaza_e = Place::where('Clave', $plaza)->first();
				$user_->plazas()->attach($plaza_e);
			}			
		}

		if(isset($image)){
			$ext = $image->getClientOriginalExtension();
			$name = 'user_'.$time. '.' .$ext;
			$image->move(public_path('img/users'),$name);

			$input['image'] = $name ;

			if(strcmp($image_old,'avatar-larus.jpeg') != 0){
				$filename = public_path() . '/img/users/' . $image_old;
				if (\File::exists($filename)) {
					\File::delete($filename);
				}
			}


		}


		//delete first a role
		$rolUser = $user->roles()->get();
		$role = Sentinel::findRoleBySlug($rolUser[0]->slug);
		$role->users()->detach($user);
		if(Sentinel::update($user, $input)) {
			$slug = $request->input('roles');
			// find a role
			$role = Sentinel::findRoleBySlug($slug);
			//add an user to role
			$role->users()->attach($user);

			flash()->success('El usuario ha sido actualizado.');
			return redirect()->to('users');
		}

	}

	/**
	 * @param $id
	 */
	public function destroy($id){
		if(Sentinel::hasAccess('user.delete')){
			if($user = Sentinel::findById($id)) {
				$image_old = $user->image;
				$user->delete();

				if(strcmp($image_old,'avatar-larus.jpeg') != 0){
					$filename =  public_path() . '/img/users/' . $image_old;
					if (\File::exists($filename)) {
						\File::delete($filename);
					}
				}

			}
		}else{
			return response()->json(['error'=>'No tiene permisos para acceder a esta area.'],401);

		}

	}



}