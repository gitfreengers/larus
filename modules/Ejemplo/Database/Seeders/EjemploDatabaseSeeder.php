<?php namespace Modules\Ejemplo\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EjemploDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		DB::table('modules')->insert([
			['module_name' => 'Ejemplo']
		]);
		$module_id = DB::getPdo()->lastInsertId();

		DB::table('modules_permissions')->insert([
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Ver ejemplos',
				'permission'    =>  'ejemplo.view'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Crear tarea',
				'permission'    =>  'ejemplo.create'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Actualizar tarea',
				'permission'    =>  'ejemplo.update'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Eliminar tarea',
				'permission'    =>  'ejemplo.delete'
			]
		]);
	}

}