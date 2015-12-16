<?php namespace Modules\Tasks\Entities;
   
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Roles\Entities\Rol;

class Task extends Model {
    /**
     * @var string
     */
    protected $table = 'tasks';
    /**
     * User model name
     * @var string
     */
    protected static $userModel = 'Modules\User\Entities\User';
    /**
     * Note model name
     * @var string
     */
    protected static $noteModel = 'Modules\Tasks\Entities\Note';

    /**
     * Flow model name
     * @var string
     */
    protected static $flowModel = 'Modules\Tasks\Entities\Flow';
    /**
     * Flow model name
     * @var string
     */
    protected static $alertModel = 'Modules\Tasks\Entities\Alert';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'flow_id',
        'name',
        'description',
        'start_date',
        'due_date',
        'status',
        'progress',
        'user_id_done',
        'done_date'
    ];


    /**
     * The Note Relationship.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes(){
        return $this->hasMany(static::$noteModel,'task_id');
    }
    /**
     * The User Relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(static::$userModel);
    }
    public function alerts(){
        return $this->hasMany(static::$alertModel,'task_id');
    }
    /**
     * The Flow Relationship.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function flow(){
        return $this->belongsTo(static::$flowModel);
    }
    /**
     * Search users in that role
     * @param $role_id
     * @return mixed
     */
    private function roles($id){
        $role = Rol::find($id);
        return $role->users;
    }
    /**
     * Add task_id and user_id table task_user
     * @param $user_id
     */
    public function addUser($id){
        $this->users()->sync([$id]);

    }
    /**
     * Add task_id and array (user_id) table task_user
     * @param $role_id
     */
    public function addRole($id){
        $array_id = [];
        $roles  = $this->roles($id);
        foreach($roles as $user){
            array_push($array_id, $user->id);
        }
        $this->users()->sync($array_id);
    }

    private function today(){
        return Carbon::now();
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeNoDone($query){
        return $query->where('status','!=','done');

    }

    /**
     * @param $query
     * @return mixed
     */

    public function scopeDone($query){
        return $query->where('status','=','done');
    }


    public function scopeOutTime($query){
        return $query->where('due_date','<', $this->today());
    }

}