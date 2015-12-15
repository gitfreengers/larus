<?php namespace Modules\Tasks\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    protected $table = 'notes';
    protected $fillable = ['task_id','user_id','comment'];
    // Relationships
    public function hasTask(){
        return $this->belongsTo('Task');
    }

    public function users(){
        return $this->belongsToMany('Modules\User\Entities\User');
    }

}