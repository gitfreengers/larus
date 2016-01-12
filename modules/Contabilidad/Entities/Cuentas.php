<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Cuentas extends Model {
	
    protected $table = "Tb_Cuentas";
    protected $primaryKey = 'NUMERO';
    public $timestamps = false;
    
    protected $fillable = [
		'NUMERO',
    	'BANCO',
    	'SUCURSAL',
    	'EJECUTIVO',
    	'TIPO',
    	'DESCRIPCION',	
    	'CC_CUENTA',
    	'TIPOCHEQUE',
    	'CUENTACOMPLEMENTARIA'
    ];
    
    public function bancoM(){
    	return $this->hasOne('Modules\Contabilidad\Entities\Place', 'Clave', 'BANCO');
    }

    public static function cuentasArray($usuario_id) {
    	
    	$cuentas = array();
    	$cuentas[''] = "Seleccione...";
    	
    	if($usuario_id != null){
	    	$usuario = User::find($usuario_id);
	    	$items = Cuentas::where('BANCO', $usuario->plaza_matriz_id)->select('NUMERO', 'CC_CUENTA', 'BANCO')->get();
    	}else{
    		$items = Cuentas::select('NUMERO', 'CC_CUENTA', 'BANCO')->get();
    	}
    	
    	foreach ($items as $item)
    	{
    		$cuentas[$item->NUMERO.'|'.$item->CC_CUENTA.'|'.$item->BANCO] = $item->NUMERO;
    	}
    	
    	return $cuentas;
    }
    
    public static function cuentasDolaresArray() {
    	
    	$cuentas = array();
    	
    	$items = Cuentas::where('TIPO', 'Cheque-USD')->select('NUMERO', 'CC_CUENTA', 'CUENTACOMPLEMENTARIA', 'BANCO')->get();
    	foreach ($items as $item)
    	{
    		$cuentas[$item->NUMERO.'|'.$item->CC_CUENTA.'|'.$item->CUENTACOMPLEMENTARIA.'|'.$item->BANCO] = $item->NUMERO;
    	}
    	
    	return $cuentas;
    }
}