<?php namespace Modules\Tasks\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Flow extends Model {
    /**
     * Step model name
     * @var string
     */
    protected static $stepModel = 'Modules\Tasks\Entities\Step';
    /**
     * Task model name
     * @var string
     */
    protected  static $taskModel = 'Modules\Tasks\Entities\Task';

    /**
     * @var string
     */
    public $table = "flows";
    /**
     * the fillable columns
     * @var array
     */
    protected $fillable = ['name', 'description', 'module', 'active'];
    /**
     * The steps
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps(){
        return $this->hasMany(static::$stepModel);
    }

    /**
     * The tasks
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(){
        return $this->hasMany(static::$taskModel);
    }


    /**
     * @param $query
     * @param $module
     * @return mixed
     */
    public function scopeByModule($query, $module){
        return $query->where('module', $module);
    }
    /**
     * @param $value
     * @return string
     */
    public function getActivePresentedAttribute($value){
        return empty($this->active) ? "No" : "Si";
    }
}