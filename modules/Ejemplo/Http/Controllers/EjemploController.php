<?php namespace Modules\Ejemplo\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Request;
use Modules\Ejemplo\Entities\Example;
use Modules\Ejemplo\Http\Requests\EjemploRequest;

class EjemploController extends Controller {
	
 public function index()
    {
        $examples = Example::orderBy('id', 'desc')->get();

        return view('ejemplo::index')->with('examples', $examples);
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$example = new Example();
    	$mode = 'create';
    	return view('ejemplo::form', compact('example', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EjemploRequest $request)
    {
    	$example = new Example();
    	$example->fill($request->all());
    	$example->save();
        return \Redirect::route('ejemplo.index')->with('success', 'Todo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $example = Example::find($id);
        $mode = 'update';
        return view('ejemplo::form', compact('example', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EjemploRequest $request, $id)
    {

    	$example = Example::find($id);
    	$example->fill($request->all());
    	$example->update();
    	return \Redirect::route('ejemplo.index')->with('success', 'Todo actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    	Example::destroy($id);
    	return \Redirect::route('ejemplo.index')->with('success', 'Todo eliminado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    	Example::destroy($id);
    	return \Redirect::route('ejemplo.index')->with('success', 'Todo eliminado correctamente');
    }
	
}