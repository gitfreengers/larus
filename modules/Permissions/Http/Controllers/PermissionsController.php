<?php namespace Modules\Permissions\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Native\Facades\Sentinel;

use Modules\Permissions\Entities\Module;
use Modules\Roles\Entities\Rol;

class PermissionsController extends Controller {




	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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

        if(Sentinel::hasAccess(['role.permissions'])){
            // Execute this code if the user has permission
            //find role by id
            $roles = Sentinel::findRoleById($id);
            // find all package with his permissions
            $permissions = Module::with('permissions')->get();

            return view('permissions::create', compact('permissions','roles'));
        }else{

			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();

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
        $permissions = Module::with('permissions')->get();

        // find role by id
        $role  = Sentinel::findRoleById($id);
        // inputs
        $data  = $request->get('data');
        $value = $request->get('value');


           if(isset($role->permissions[$value])){
               $role->updatePermission($value,($data =='true')?true:false);
               $role->save();
               return "update";
           }else{
               $role->addPermission($value,($data =='true')?true:false);
               $role->save();
               return "add";
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
		//
	}

}
