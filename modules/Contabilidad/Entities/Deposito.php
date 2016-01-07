<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model {

    protected $table = "contabilidad_depositos";
	
    protected $fillable = [
	    'banco', 
    	'fecha', 
    	'monto', 
    	'moneda', 
    	'cuenta_contable',
    	'complementaria',
    	'usuario_id',
    	'estatus',
    	'usuario_cancelacion_id',
    	'fecha_cancelacion_id',
    	'tipo_pago',
    	'folio',
    	'global'    		
    ];

    public function depositosAplicados()
    {
    	return $this->hasMany('Modules\Contabilidad\Entities\DepositoAplicacion', 'deposito_id', 'id');
    }
    
    public function usuarioCancelacion(){
    	return $this->hasOne('Modules\User\Entities\User', 'id', 'usuario_cancelacion_id');
    }
    
}