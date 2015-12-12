<?php namespace Modules\Notifications\Entities;
   
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use Modules\Roles\Entities\Rol;

class Notification extends Model {
    /**
     * User model name
     * @var string
     */
    protected static $userModel = 'Modules\User\Entities\User';
    /**
     * @var string
     */
    protected $table = 'notification';
    /**
     * @var array
     */
    protected $fillable = ['role_id','icon','name','description','url'];

    /**
     * The User Relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(static::$userModel);
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

    /**
     * if was read
     * @param $user_id
     */
    public function addRead($id){
        $this->users()->updateExistingPivot($id,['read'=>true]);
    }

    /**
     * if was not read
     * @param $user_id
     */
    public function addNoRead($id){
        $this->users()->updateExistingPivot($id,['read'=>false]);
    }

    /**
     * if Active is 1, its like to delete
     * @param $user_id
     */
    public function addActive($id){
        $this->users()->updateExistingPivot($id,['active'=>true]);
    }

    /**
     * if Active is 0 its no delete
     * @param $user_id
     */
    public function addNoActive($id){
        $this->users()->updateExistingPivot($id,['active'=>false]);
    }

    /**
     * @param $user
     * @param $fields
     */
    public function smail($user,$fields){
        Mail::send('notifications::emails.notification',['user' => $user,'fields'=> $fields],
            function ($m) use ($user,$fields){
                $m->to($user->email)
                    ->subject('Usted tiene una nueva notificación '.$fields['title']);
            });
    }


    /**
     * Notifications no read and not delete
     * @param $query
     * @return mixed
     */
    public function scopeNoRead($query){
        return $query->where('read',false)->where('active',false);

    }

    /**
     * Notifications read and not delete
     * @param $query
     */
    public function scopeRead($query){
        return $query->where('read',true)->where('active',false);
    }

}