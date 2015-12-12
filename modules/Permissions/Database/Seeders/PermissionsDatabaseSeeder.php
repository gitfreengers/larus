<?php namespace Modules\Permissions\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// enter seed data
		\DB::table('modules')->insert([
			['module_name' => 'Usuarios'],
			['module_name' => 'Roles'],
			['module_name' => 'Notificaciones'],
			['module_name' => 'Tareas']
		]);


		\DB::table('modules_permissions')->insert([
			//users
			[
				'module_id'    =>  1,
				'display_name'  =>  'Ver usuarios',
				'permission'    =>  'user.view'
			],
			[
				'module_id'    =>  1,
				'display_name'  =>  'Crear usuario',
				'permission'    =>  'user.create'
			],
			[
				'module_id'    =>  1,
				'display_name'  =>  'Actualizar usuario',
				'permission'    =>  'user.update'
			],
			[
				'module_id'    =>  1,
				'display_name'  =>  'Eliminar usuario',
				'permission'    =>  'user.delete'
			],
			// roles
			[
				'module_id'    =>  2,
				'display_name'  =>  'Ver roles',
				'permission'    =>  'role.view'
			],
			[
				'module_id'    =>  2,
				'display_name'  =>  'Crear rol',
				'permission'    =>  'role.create'
			],
			[
				'module_id'    =>  2,
				'display_name'  =>  'Actualizar rol',
				'permission'    =>  'role.update'
			],
			[
				'module_id'    =>  2,
				'display_name'  =>  'Eliminar rol',
				'permission'    =>  'role.delete'
			],

			[
				'module_id'    =>  2,
				'display_name'  =>  'Asignar Permisos',
				'permission'    =>  'role.permissions'
			],
			//notifications
			[
				'module_id'    =>  3,
				'display_name'  =>  'Ver notificaciones',
				'permission'    =>  'notification.view'
			],
			[
				'module_id'    =>  3,
				'display_name'  =>  'Crear notificación',
				'permission'    =>  'notification.create'
			],
			[
				'module_id'    =>  3,
				'display_name'  =>  'Actualizar notificación',
				'permission'    =>  'notification.update'
			],
			[
				'module_id'    =>  3,
				'display_name'  =>  'Eliminar notificación',
				'permission'    =>  'notification.delete'
			],
			//tareas
			[
				'module_id'    =>  4,
				'display_name'  =>  'Ver tareas',
				'permission'    =>  'task.view'
			],
			[
				'module_id'    =>  4,
				'display_name'  =>  'Crear tarea',
				'permission'    =>  'task.create'
			],
			[
				'module_id'    =>  4,
				'display_name'  =>  'Actualizar tarea',
				'permission'    =>  'task.update'
			],
			[
				'module_id'    =>  4,
				'display_name'  =>  'Eliminar tarea',
				'permission'    =>  'task.delete'
			]




		]);

		// $this->call("OthersTableSeeder");
	}

}