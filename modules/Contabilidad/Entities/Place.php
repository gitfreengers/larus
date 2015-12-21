<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Place extends Model {
	
    protected $table = "Tb_Plazas";
    protected $primaryKey = 'Clave';
    
    protected static $userModel = 'Modules\User\Entities\User';
    
    protected $fillable = [
		'Clave',
    	'Nombre'	
    ];

    public function users(){
    	return $this->belongsToMany(static::$userModel, 'place_user', 'tb_plazas_clave', 'user_id');
    }
    
    public function addUser($id){
    	$this->users()->sync([$id]);
    }
    
    public static function plazasArray() {
    	$plazas = array();
    	$items = Place::all(['clave','nombre']);
    	$plazas[''] = "Seleccione...";
    	foreach ($items as $data)
    	{
    		$plazas[$data->clave] = $data->nombre;
    	}
    	
    	return $plazas;
    }
}