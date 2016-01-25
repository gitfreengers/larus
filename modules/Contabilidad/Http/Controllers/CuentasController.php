<?php namespace Modules\Contabilidad\Http\Controllers;


use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Pingpong\Modules\Routing\Controller;

use Modules\Contabilidad\Entities\Cuentas;
use Modules\Contabilidad\Http\Requests\CuentasRequest;
use Modules\Contabilidad\Entities\Place;

class CuentasController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
    	if(Sentinel::check()){
	    	if(Sentinel::hasAccess('cuentas.view')){
		        $cuentas = Cuentas::all();
		        $cuentas->load('bancom');
		        return view('contabilidad::Cuentas.index', compact('cuentas'));    		
	    	}
	        
	        alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
	        return back();    	
    	}else{
    		return redirect('login');
    	}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
    	$bancos = Place::plazasArray(null);
        return view('contabilidad::Cuentas.create', compact('bancos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CuentasRequest $request)
    {
        $cuentum = Cuentas::create($request->all());
        flash()->success('La cuenta ha sido añadida.');
        return redirect()->route('contabilidad.cuentas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $cuentum = Cuentas::findOrFail($id);

        return view('contabilidad::Cuentas.show', compact('cuentum'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cuentum = Cuentas::findOrFail($id);
        $cuentum->load('bancom');
        $bancos = Place::plazasArray(null);
        flash()->success('La cuenta ha sido modificada.');
        return view('contabilidad::Cuentas.edit', compact('cuentum', 'bancos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(CuentasRequest $request, $id)
    {       
        $cuentum = Cuentas::findOrFail($id);
        $cuentum->update($request->all());
        return redirect()->route('contabilidad.cuentas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $cuentum = Cuentas::findOrFail($id);
        
        $cuentum->delete();
        flash()->success('La cuenta ha sido eliminada.');
        return redirect()->route('contabilidad.cuentas.index');
    }

}
