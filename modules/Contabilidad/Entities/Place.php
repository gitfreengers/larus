<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Place extends Model {
	
    protected $table = "Tb_Plazas";

    protected $fillable = [
	'Clave',
    	'Nombre'	
    ];

}