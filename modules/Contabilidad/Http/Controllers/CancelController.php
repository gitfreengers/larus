<?php namespace Modules\Contabilidad\Http\Controllers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Pingpong\Modules\Routing\Controller;

use Carbon\Carbon;
use Modules\Contabilidad\Entities\Deposito;
use Modules\Contabilidad\Entities\Place;
use Modules\Contabilidad\Http\Requests\DepositoConsultaRequest;


class CancelController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index() {
		if(Sentinel::check()){
			if (Sentinel::hasAccess ( 'cancelaciones.view' )) {
				$plazas = Place::plazasArray($this->user_auth->id);
				return view ( 'contabilidad::Cancel.index', compact ( "plazas" ) );
			} else {
				alert ()->error ( 'No tiene permisos para acceder a esta area.', 'Oops!' )->persistent ( 'Cerrar' );
				return back ();
			}
		
		}else{
			return redirect('login');
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
			$query = Deposito::select('contabilidad_depositos.*');
			if ($request->plaza){
				$plazaF = Place::where('Clave', $request->plaza)->first();
				$plaza = $plazaF->Oficina;
				$query->join('contabilidad_deposito_aplicacion', 'contabilidad_depositos.id', '=', 'contabilidad_deposito_aplicacion.deposito_id')
					->join('contabilidad_sales', 'contabilidad_sales.id', '=', 'contabilidad_deposito_aplicacion.venta_id')
					->where(function ($query) use ($plaza) {
						$query->where('cl_location', $plaza)->where('op_location', $plaza);
				});
			}
			if ($request->fecha){
				$fecha = Carbon::createFromFormat('m/d/Y', $request->fecha);
				$query->orWhere(function($query) use ($fecha){
					$query->whereDate('fecha', '=', $fecha->toDateString());	
				});
			}
			if ($request->monto){
				$query->orWhere('monto', $request->monto);
			}
			if ($request->referencia){
				
				$referencia = $request->referencia;
				if ($request->plaza){
					$query->where(function ($query) use ($referencia) {
							$query->where('reference', $referencia);
					});
				}else{
					$query->join('contabilidad_deposito_aplicacion', 'contabilidad_depositos.id', '=', 'contabilidad_deposito_aplicacion.deposito_id')
						->join('contabilidad_sales', 'contabilidad_sales.id', '=', 'contabilidad_deposito_aplicacion.venta_id')
						->orWhere(function ($query) use ($referencia) {
							$query->where('reference', $referencia);
					});
					
				}
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