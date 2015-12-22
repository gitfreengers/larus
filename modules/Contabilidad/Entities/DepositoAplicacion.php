<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class DepositoAplicacion extends Model {

    protected $table = "deposito_aplicacion";
	
    protected $fillable = [
		'deposito_id',
	    'venta_id', 
	    'usuario_id', 
    	'cantidad'
    ];

    public function deposito()
    {
    	return $this->belongsTo('Modules\Contabilidad\Entities\Deposito');
    }
    
    public function venta()
    {
    	return $this->belongsTo('Modules\Contabilidad\Entities\Sales');
    }
}