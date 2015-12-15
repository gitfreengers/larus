<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model {

	//

    protected $table = 'module_permissions';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_id', 'display_name','action'];



}
