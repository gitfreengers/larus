<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

	//
    protected $table = 'notifications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','role_id','title','description','url','read','status'];


    public function hasUser(){
        return $this->hasOne('App\User','id','user_id');
    }

}
