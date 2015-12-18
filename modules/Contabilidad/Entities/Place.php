<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Place extends Model {
	
	protected $table = "Tb_plazas";

    protected $fillable = [
	    'clave',
    	'nombre',
    	'oficinas'	
    ];

}