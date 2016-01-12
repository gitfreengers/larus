<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Comban extends Model {
	
    protected $table = "Tb_COMBAN";
    
    protected $fillable = [
		'BANCO',
    	'PLANPAGOS',
    	'PLAZA',
    	'PORCOMISION',
    	'PORIVACOMISION',
    	'MONEDA',
    	'DESCRIPCION',
    	'CUENTABANCARIA',
    	'CUENTACONTABLEBANCOS',
    	'CUENTACONTABLECOMPLEMENTARIAUSD'	
    ];
    
    public static function combanArray($plaza_id) {
    	return Comban::where('BANCO', str_pad($plaza_id, 4, "0", STR_PAD_LEFT))->get();
    }
}