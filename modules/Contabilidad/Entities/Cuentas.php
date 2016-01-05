<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Cuentas extends Model {
	
    protected $table = "Tb_Cuentas";
    protected $primaryKey = 'NUMERO';
    
    protected $fillable = [
		'NUMERO',
    	'BANCO'
    ];

    public static function cuentasArray($usuario_id) {
    	
    	$cuentas = array();
    	$cuentas[''] = "Seleccione...";
    	
    	if($usuario_id != null){
	    	$usuario = User::find($usuario_id);
	    	$items = Cuentas::where('BANCO', $usuario->plaza_matriz_id)->get()->lists('NUMERO', 'NUMERO');
    	}else{
    		$items = Cuentas::all()->lists('NUMERO', 'NUMERO');
    	}
    	
    	foreach ($items as $key=>$value)
    	{
    		$cuentas[$key] = $value;
    	}
    	
    	return $cuentas;
    }
}