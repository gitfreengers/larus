<?php namespace App\Http\Controllers;

use App\Http\Requests;


use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Support\Str;




// Refactoring ASAP
class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Sentinel::hasAccess('user.view')){
            $users = User::all();
            return view('users.index', compact('users'));
        }else{
            return back()
                ->withErrors('You are not permitted to access this area.');
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        if(Sentinel::hasAccess('user.create')){
            $roles = Role::all()->lists('name','slug');
            return view('users.create', compact('roles'));
        }else{
            return back()->withErrors('You are not permitted to access this area.');
        }

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, UserCreateRequest $UserCreateRequest)
	{
       // $input = $request->all();
        $slug = $request->input('roles');
        $image = $request->file('image');
        //find by slug the role
        $role = Sentinel::findRoleBySlug($slug);
        //create the user
        $time = Str::slug(\Carbon\Carbon::now());

        if(isset($image)){
            $ext = $image->getClientOriginalExtension();
            $name = 'user_'.$time. '.' .$ext;
            $image->move(public_path('img/user_img'),$name);
        }

        $input = $request->except(['image']);
        $input['image'] = (isset($image))? $name : 'avatar-larus.jpeg';
        $user = Sentinel::register($input);





        // we activate the user
        $activation = Activation::create($user);
        $code = $activation->code;
        //if the activation was success, we assignig the role to user
        if(Activation::complete($user, $code))
        {
            $role->users()->attach($user);
            return \Redirect::to('users')
                ->withSuccess('El usuario ha sido añadido.');

        }
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
            $roles = Role::all()->lists('name','slug');

            return view('users.edit',compact('users','roles','rolUser'));
        }else{
            return back()
                ->withErrors('You are not permitted to access this area.');
        }
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

        if(isset($image)){
            $ext = $image->getClientOriginalExtension();
            $name = 'user_'.$time. '.' .$ext;
            $image->move(public_path('img/user_img'),$name);

            $input['image'] = $name ;

            if(strcmp($image_old,'avatar-larus.jpeg') != 0){
                $filename = public_path() . '/img/user_img/' . $image_old;
                if (\File::exists($filename)) {
                    \File::delete($filename);
                }
            }


        }


        //delete first a role
        $rolUser = $user->roles()->get();
        $role = Sentinel::findRoleBySlug($rolUser[0]->slug);
        $role->users()->detach($user);
        // continue proccess update
        // update an user
        if(Sentinel::update($user, $input))
        {
            $slug = $request->input('roles');
            // find a role
            $role = Sentinel::findRoleBySlug($slug);
            //add an user to role
            $role->users()->attach($user);
            return \Redirect::to('users')
                ->withSuccess('Usuario actualizado.');
        }

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function destroy($id)
    {
        if($user = Sentinel::findById($id)) {
            $image_old = $user->image;
            $user->delete();

            if(strcmp($image_old,'avatar-larus.jpeg') != 0){
                $filename = public_path() . '/img/user_img/' . $image_old;
                if (\File::exists($filename)) {
                    \File::delete($filename);
                }
            }
            $affectedRows = 1;

        }
        return $affectedRows;

    }






}
