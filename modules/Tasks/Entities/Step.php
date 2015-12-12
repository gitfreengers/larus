<?php namespace Modules\Tasks\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Step extends Model {


    protected $table = 'flows_steps';


    /**
     * User model name
     * @var string
     */
    protected static $userModel = 'Modules\User\Entities\User';

    /**
     * Flow model name
     * @var string
     */
    protected static $flowModel ='Modules\Tasks\Entities\Flow';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name', 'description', 'order', 'is_last'];

    /**
     * The flow this step belongs to
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flow(){
        return $this->belongsTo(static::$flowModel);
    }
}