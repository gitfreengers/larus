<?php namespace Ekko\PackageTest\Http\Controllers;

use App\Http\Controllers\Controller;
use Ekko\PackageTest\Http\Requests\TesteRequest;
use Ekko\PackageTest\Test;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;

class TestController extends Controller {

	/**
	 * Display a listing of the resource.
	 * @return view('package::view.name');
	 * @return Response
	 */
	public function index()
	{
		//
        if(Sentinel::hasAccess('test.view')){
            $tests = Test::all();
            return view('PackageTest::test.index', compact('tests'));
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
        if(Sentinel::hasAccess('test.create')){
            // Execute this code if the user has permission
            return view('PackageTest::test.create');
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
	public function store( Request $request, TesteRequest $testeRequest )
	{
		//
        $test = Test::create($request->all());

        if($test)
        {
            return \Redirect::to('test')
                ->withSuccess('El test ha sido añadido.');

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
        if(Sentinel::hasAccess('test.create')){
            $test = Test::find($id);

            return view('PackageTest::test.create', compact('test'));
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
	public function update($id, Request $request, TesteRequest $testeRequest )
	{
		//

        $input = $request->all();

        $test = Test::find($id);

        $test->fill($input);
        $test->save();
        return \Redirect::to('test')
            ->withSuccess('El test ha sido actualizado.');

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
        $test = Test::find($id);
        $test->delete();
        $affectedRows = 1;
        return $affectedRows;

	}

}
