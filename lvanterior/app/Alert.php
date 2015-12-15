<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Alert extends Model {

	//
    //
    protected $table = 'alerts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['task_id','title','description','url','alert_display'];


    public function hasTask(){
        return $this->hasOne('App\Task');
    }

}
