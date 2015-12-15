<?php
/**
 * Created by PhpStorm.
 * User: Kontiki
 * Date: 25/05/2015
 * Time: 11:32 AM
 */
use \Illuminate\Database\Seeder;
use Cartalyst\Sentinel\Native\Facades\Sentinel;



class UserTableSeeder extends Seeder{
    public function run(){
        \DB::table('users')->truncate();
        \DB::table('roles')->truncate();
        \DB::table('role_users')->truncate();
        $role = [
            'name' => 'Administrator',
            'slug' => 'administrator',
            'permissions' => [
                'user.view'   => true,
                'user.create' => true,
                'user.update' => true,
                'user.delete' => true,
                'role.view'   => true,
                'role.create' => true,
                'role.update' => true,
                'role.delete' => true,
                'role.permissions' => true,
            ]
        ];
        $adminRole = Sentinel::getRoleRepository()->createModel()->fill($role)->save();
        $admin = [
            'email'    => 'test@test.com',
            'password' => 'test',
            'image' => 'avatar-larus.jpeg',
            'position' => 'Administrador',
            'first_name' => 'Admin',
            'last_name' => 'example'

        ];



        $adminUser = Sentinel::registerAndActivate($admin);

        /*$user = Sentinel::findById($adminUser->id);
        $input['image'] = 'avatar-larus.jpeg';
        $input['position'] = 'Administrador';
        $input['first_name'] = 'Admin';
        $input['last_name'] = 'example';
        Sentinel::update($user, $input);*/


        $adminUser->roles()->attach($adminRole);

    }

}