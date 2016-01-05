<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Cuentas extends Model {
	
    protected $table = "Tb_Cuentas";
    protected $primaryKey = 'NUMERO';
    
    protected $fillable = [
		'NUMERO',
    	'BANCO',
    	'CC_CUENTA',
    	'TIPO'
    ];

    public static function cuentasArray($usuario_id) {
    	
    	$cuentas = array();
    	$cuentas[''] = "Seleccione...";
    	
    	if($usuario_id != null){
	    	$usuario = User::find($usuario_id);
	    	$items = Cuentas::where('BANCO', $usuario->plaza_matriz_id)->get()->lists('NUMERO', 'CC_CUENTA');
    	}else{
    		$items = Cuentas::all()->lists('NUMERO', 'CC_CUENTA');
    	}
    	
    	foreach ($items as $key=>$value)
    	{
    		$cuentas[$value.'|'.$key] = $value;
    	}
    	
    	return $cuentas;
    }
    
    public static function cuentasDolaresArray() {
    	
    	$cuentas = array();
    	
    	$items = Cuentas::where('TIPO', 'Cheque-USD')->select('NUMERO', 'CC_CUENTA', 'CUENTACOMPLEMENTARIA')->get();
    	foreach ($items as $item)
    	{
    		$cuentas[$item->NUMERO.'|'.$item->CC_CUENTA.'|'.$item->CUENTACOMPLEMENTARIA] = $item->NUMERO;
    	}
    	
    	return $cuentas;
    }
}