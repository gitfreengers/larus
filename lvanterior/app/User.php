<?php namespace App;



use Cartalyst\Sentinel\Users\EloquentUser ;
use App\Notification;


class User extends EloquentUser{
    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
        'position',
        'image',
    ];

    public function hasNotification(){
        return $this->hasMany('App\Notification');
    }





}
