<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RolesCreateRquest;
use App\Http\Controllers\Controller;
use App\Role;
use Cartalyst\Sentinel\Roles\RoleInterface;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Illuminate\Support\Facades\DB;

class RolesController extends Controller {





	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index()
	{
		//
        if(Sentinel::hasAccess('role.view')){
            $roles = Role::all();

            return view('roles.index', compact('roles'));
        }else{
            return back()->withErrors('You are not permitted to access this area.');
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        if(Sentinel::hasAccess(['role.create'])){
            // Execute this code if the user has permission
            return view('roles.create');
        }else{

            // Execute this code if the permission check failed
            return back()
                ->withErrors('No tiene permisos para acceder a esta area.');

        }
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, RolesCreateRquest $rolesCreateRquest)
	{
		//



        $role = Role::create($request->all());

        if($role)
        {
            return \Redirect::to('roles')
                ->withSuccess('El rol ha sido añadido.');

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

        if(Sentinel::hasAccess(['role.update'])){
            // Execute this code if the user has permission
            $roles = Sentinel::findRoleById($id);

            return view('roles.create', compact('roles'));
        }else{
            // Execute this code if the permission check failed
            return back()
                ->withErrors('No tiene permisos para acceder a esta area.');

        }

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request, RolesCreateRquest $rolesCreateRquest)
	{
		//
        $input = $request->all();

        $role = Sentinel::findRoleById($id);
        $role->fill($input);
		$role->save();
        return \Redirect::to('roles')
            ->withSuccess('El rol ha sido actualizado.');
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

         $affectedRows = DB::table('role_users')->where('role_id','=', $id)->get();

        if(empty($affectedRows))
        {
            if($role = Sentinel::findRoleById($id))
            {
                $role->delete();
                $affectedRows = 1;
                return $affectedRows;
            }
            return \Redirect::to('roles')
                ->withErrors('No se pudo eliminar el rol.');

        }else
        {
            $affectedRows = 0;
            return $affectedRows;

        }




    }

}
