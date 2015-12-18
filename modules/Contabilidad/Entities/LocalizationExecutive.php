<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class LocalizationExecutive extends Model {

    protected $table = "locaciones_ejecutivas";

    protected $fillable = [
	    'id_usuario',
    	'nombre',
    	'tipo',
    	'codigoSegmento',	
    	'segmentoRP',	
    	'clave',	
    	'prefijoConvenios',	
    	'numero_plaza',	
    	'codigoCiudad',	
    	'meta_unica',	
    ];

}