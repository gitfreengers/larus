<?php namespace Modules\Permissions\Entities;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

	//

    protected $table = 'modules';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_name'];


    public function permissions(){
        return $this->hasMany('Modules\Permissions\Entities\ModulePermission','module_id');
    }

}
