<?php


namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\Contabilidad\Entities\Place;
use Modules\Contabilidad\Entities\Deposito;
use Modules\Contabilidad\Http\Requests\DepositoConsultaRequest;
use Modules\Contabilidad\Entities\DepositoAplicacion;

class CancelController extends Controller {
	public function index() {
		if (Sentinel::hasAccess ( 'cancelaciones.view' )) {
			$plazas = Place::plazasArray ();
			return view ( 'contabilidad::Cancel.index', compact ( "plazas" ) );
		} else {
			alert ()->error ( 'No tiene permisos para acceder a esta area.', 'Oops!' )->persistent ( 'Cerrar' );
			return back ();
		}
	}
	
	public function obtenerDepositos(DepositoConsultaRequest $request)
	{
		if ($request->plaza == ''
				&& $request->fecha == ''
				&& $request->monto == ''
				&& $request->referencia == ''){
					$depositos = Deposito::all();
		}else{
			$query = DB::table('depositos');
			if ($request->plaza){
				$query->leftJoin('place_user', 'place_user.user_id', '=', 'depositos.usuario_id')->where('tb_plazas_clave', $request->plaza);
			}
			if ($request->fecha){
				$query->orWhere('fecha', $request->fecha);
			}
			if ($request->monto){
				$query->orWhere('monto', $request->monto);
			}
			if ($request->referencia){
				$query->orWhere('referencia', $request->referencia);
			}
			$depositos = $query->get();
		}
	
		return response()->json($depositos);
	}
	
	/**
	 * @param $id
	 */
	public function destroy($id){
		//if(Sentinel::hasAccess('user.delete')){
		if($depositos = Deposito::find($id)) {
			flash()->success('El deposito se ha cancelado.');
			$depositos->estatus = 1;
			$depositos->update();
			$depositosAplicados = $depositos->depositosAplicados;
			foreach ($depositosAplicados as $depositoAplicado){
				if ($depositoAplicado->estatus == 0){
					$depositoAplicadoNew = $depositoAplicado->replicate();
					$depositoAplicadoNew->cantidad = -$depositoAplicado->cantidad;
					$depositoAplicadoNew->estatus = 1;
					$depositoAplicadoNew->save();
					$venta = $depositoAplicado->venta;
					$venta->ammount_applied = $venta->ammount_applied - $depositoAplicado->cantidad;
					$venta->save();
				}
			}
		}

		//}else{
		//return response()->json(['error'=>'No tiene permisos para acceder a esta area.'], 401);
		//}
	
	}
	
}