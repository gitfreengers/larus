<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Pingpong\Modules\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Modules\Contabilidad\Entities\Deposito;
use Modules\Contabilidad\Entities\Place;
use Modules\Contabilidad\Http\Requests\DepositoConsultaRequest;
use Carbon\Carbon;

class CancelController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index() {
		if (Sentinel::hasAccess ( 'cancelaciones.view' )) {
			$plazas = Place::plazasArray($this->user_auth->id);
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
			$query = Deposito::select('depositos.*');
			if ($request->plaza){
				$plazaF = Place::where('Clave', $request->plaza)->first();
				$plaza = $plazaF->Oficina;
				$query->join('deposito_aplicacion', 'depositos.id', '=', 'deposito_aplicacion.deposito_id')
					->join('sales', 'sales.id', '=', 'deposito_aplicacion.venta_id')
					->where(function ($query) use ($plaza) {
						$query->where('cl_location', $plaza)->where('op_location', $plaza);
					});
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
			$depositos = $query->distinct()->get();
		}
		
		if(count($depositos) > 0){
			foreach ($depositos as $deposito){
				$deposito->load('depositosaplicados', 'depositosaplicados.venta', 'usuariocancelacion');			
			}
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
			$depositos->usuario_cancelacion_id = $this->user_auth->id;
			$depositos->fecha_cancelacion = Carbon::now();
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