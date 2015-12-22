<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Deposito extends Model {

    protected $table = "depositos";
	
    protected $fillable = [
	    'banco', 
    	'fecha', 
    	'referencia', 
    	'monto', 
    	'moneda', 
    	'cuenta_contable',
    	'complementaria',
    	'usuario_id'	
    ];

}