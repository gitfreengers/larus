<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model {

    protected $table = "deposito_aplicacion";
	
    protected $fillable = [
		'deposito_id',
	    'venta_id', 
	    'usuario_id', 
    	'cantidad'
    ];

}