<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

	//

    protected $table = 'modules';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_name', 'route'];


    public function permissions(){
        return $this->hasMany('App\ModulePermission','module_id');
    }

}
