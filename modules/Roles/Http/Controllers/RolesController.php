<?php namespace Modules\Roles\Http\Controllers;

use Modules\Roles\Entities\Rol;
use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use App\Http\Requests;
use Modules\Roles\Http\Requests\RolesCreateRquest;
use Illuminate\Http\Request;

class RolesController extends Controller {

	public function index(){

		if(Sentinel::hasAccess('role.view')){
			$roles = Rol::all();
			return view('roles::index', compact('roles'));
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(){

		if(Sentinel::hasAccess(['role.create'])){
			return view('roles::create');
		}else{
			alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
			return back();
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, RolesCreateRquest $rolesCreateRquest){
		$role = Rol::create($request->all());
		flash()->success('El rol ha sido añadido.');
		return redirect()->to('roles');
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
	public function edit($id){

		if(Sentinel::hasAccess(['role.update'])){

			$roles = Sentinel::findRoleById($id);

			return view('roles::create', compact('roles'));
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
	public function update($id, Request $request, RolesCreateRquest $rolesCreateRquest)
	{
		//
		$input = $request->all();

		$role = Sentinel::findRoleById($id);
		$role->fill($input);
		$role->save();
		flash()->success('El rol ha sido actualizado.');
		return redirect()->to('roles');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function destroy($id){
		if(Sentinel::hasAccess('role.delete')){
			$affectedRows = DB::table('role_users')->where('role_id','=', $id)->get();

			if(empty($affectedRows))
			{
				if($role = Sentinel::findRoleById($id))
				{
					$role->delete();
				}
				return \Redirect::to('roles')
					->withErrors('No se pudo eliminar el rol.');

			}
		}else{
			return response()->json(['error'=>'No tiene permisos para acceder a esta area.'],401);

		}

	}
}