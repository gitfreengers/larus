<?php namespace Modules\User\Entities;
   
use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table = 'users';
    /**
     * The Step moddule name
     * @var string
     */
    protected static $stepModel = 'Modules\Tasks\Entities\Step';

    protected static $taskModel = 'Modules\Tasks\Entities\Task';
    protected static $alertModel = 'Modules\Tasks\Entities\Alert';
    protected static $notificationModel = 'Modules\Notifications\Entities\Notification';

    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'position',
        'image',
    ];
    /**
     * Get User Full Name
     * @return string
     */
    public function getFullNameAttribute(){
        return sprintf(
            '%s %s',
            $this->attributes['first_name'],
            $this->attributes['last_name']
        );
    }


    /**
     * Many users can have many tasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tasks(){
        return $this->belongsToMany(static::$taskModel);
    }

    public function alerts(){
        return $this->belongsToMany(static::$alertModel);
    }

    /**
     * The note relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notes(){
        return $this->belongsToMany('Modules\Tasks\Entities\Note');

    }

    public function steps(){
        return $this->belongsToMany(static::$stepModel);
    }

    /**
     * Many users can have many notifications
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications(){
        return $this->belongsToMany(static::$notificationModel);
    }






}