<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model {

	//

    protected $table = 'packages';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['package_name','icon'];


    public function modules(){
        return $this->hasMany('App\Module','package_id');
    }



}
