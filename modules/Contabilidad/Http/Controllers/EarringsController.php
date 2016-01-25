<?php namespace Modules\Contabilidad\Http\Controllers;

use Pingpong\Modules\Routing\Controller;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Contabilidad\Entities\Sales;

class EarringsController extends Controller {
	
	protected $user_auth;
	
	public function __construct(){
		$this->user_auth = Sentinel::getUser();
	}
	
	public function index()
	{
		if(Sentinel::check()){
			if(Sentinel::hasAccess('pendientes.view')){
				$usuario = User::find($this->user_auth->id);
				$oficinas = array();
				foreach ($usuario->plazas as $plazas){
					array_push($oficinas, $plazas->Oficina);
				}
				DB::enableQueryLog();
				$ventasPendientes = Sales::select('*',  DB::raw('SUM(ammount) as ammount, SUM(ammount_applied) as ammount_applied '))
									->whereRaw('credit_debit = ?  ', ['credit'])
									->groupBy('reference')
									->get();
				return view('contabilidad::Earrings.index', compact("ventasPendientes"));
			}else{
				alert()->error('No tiene permisos para acceder a esta area.', 'Oops!')->persistent('Cerrar');
				return back();
			}			
		}else{
			return redirect('login');
		}
	}
	
}