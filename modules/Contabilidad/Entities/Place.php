<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\User;

class Place extends Model {
	
    protected $table = "Tb_Plazas";
    protected $primaryKey = 'Clave';
    
    protected static $userModel = 'Modules\User\Entities\User';
    
    protected $fillable = [
		'Clave',
    	'Nombre',
    	'Oficina'	
    ];

    public function users(){
    	return $this->belongsToMany(static::$userModel, 'place_user', 'tb_plazas_clave', 'user_id');
    }
    
    public function addUser($id){
    	$this->users()->sync([$id]);
    }
    
    public static function plazasArray($usuario_id) {
    	
    	
    	if($usuario_id != null){
	    	$oficinas = array();
	    	$usuario = User::find($usuario_id);
	    	foreach ($usuario->plazas as $plazas){
	    		array_push($oficinas, $plazas->Oficina);
	    	}
	    	$items = Place::whereIn('oficina', $oficinas)->get()->lists('Nombre', 'Clave');
    	}else{
    		$items = Place::all()->lists('Nombre', 'Clave');
    	}
    	
    	$plazas = array();
    	$plazas[''] = "Seleccione...";
    	
    	foreach ($items as $key=>$value)
    	{
    		$plazas[$key] = $value;
    	}
    	
    	return $plazas;
    }
}