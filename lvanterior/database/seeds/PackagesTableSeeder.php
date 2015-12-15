<?php
/**
 * Created by PhpStorm.
 * User: Kontiki
 * Date: 25/05/2015
 * Time: 11:32 AM
 */
use \Illuminate\Database\Seeder;




class PackagesTableSeeder extends Seeder{
    public function run(){
        \DB::table('packages')->truncate();
        \DB::table('packages')->insert([
            [
                'package_name' => 'Dashboard',
                'icon'         => 'fa-dashboard'

            ],
            [
                'package_name' => 'Administración',
                'icon'         => 'fa-cog'

            ]
        ]);

    }

}