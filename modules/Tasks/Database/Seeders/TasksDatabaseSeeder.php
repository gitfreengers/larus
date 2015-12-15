<?php namespace Modules\Tasks\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class TasksDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		DB::table('modules')->insert([
			['module_name' => 'Tareas']
		]);
		$module_id = DB::getPdo()->lastInsertId();

		DB::table('modules_permissions')->insert([

			//tareas
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Ver tareas',
				'permission'    =>  'task.view'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Crear tarea',
				'permission'    =>  'task.create'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Actualizar tarea',
				'permission'    =>  'task.update'
			],
			[
				'module_id'    =>  $module_id,
				'display_name'  =>  'Eliminar tarea',
				'permission'    =>  'task.delete'
			]




		]);
		
		// $this->call("OthersTableSeeder");
	}

}