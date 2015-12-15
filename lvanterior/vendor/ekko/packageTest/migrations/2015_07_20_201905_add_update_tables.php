<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// create package table
        Schema::create('tests', function($table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        /**
         * Opcional
         */
        /*DB::table('packages')->insert(
            array(
                    'package_name' => 'Nombre del paquete',
                    'icon' => 'fa-cog',// icono de la plantilla
            )
        );
        $packageid = DB::getPdo()->lastInsertId(); */
        // agregamos el paquete id al cual queremos que este relacionada

        $package_id = 2;

        // insertamos en la tabla modules, el nombre de nuestro paquete

        DB::table('modules')->insert(
            array(
                'package_id' => $package_id,
                'module_name' => 'Nombre del paquete',
                'route' => 'test',// ruta del controlador index
            )
        );
         $module_id = DB::getPdo()->lastInsertId();

        // Insertamos los permisos que tendra nuestros modulo
        DB::table('module_permissions')->insert([
            [
                'module_id'    =>  $module_id,
                'display_name'  =>  'ver test',
                'permission'    =>  'test.view'
            ],
            [
                'module_id'    =>  $module_id,
                'display_name'  =>  'create test',
                'permission'    =>  'test.create'
            ],
            [
                'module_id'    =>  $module_id,
                'display_name'  =>  'actualizar test',
                'permission'    =>  'test.update'
            ],
            [
                'module_id'    =>  $module_id,
                'display_name'  =>  'delete test',
                'permission'    =>  'test.delete'
            ],
            [
                'module_id'    =>  $module_id,
                'display_name'  =>  'widget test',
                'permission'    =>  'TestWidget.view'
            ]

        ]);




	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::dropIfExists('tests');
	}

}
