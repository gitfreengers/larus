<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Alert;
class Task extends Model {

	//
    protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','role_id','user_complete_id','title','description','start_time','expire_time','read','status','process'];


    public function hasAlert(){
        return $this->hasMany('App\Alert','task_id');
    }
}
