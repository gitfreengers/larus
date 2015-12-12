<?php namespace Modules\Permissions\Entities;

use Illuminate\Database\Eloquent\Model;

class ModulePermission extends Model {

	//

    protected $table = 'modules_permissions';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_id', 'display_name'];



}
