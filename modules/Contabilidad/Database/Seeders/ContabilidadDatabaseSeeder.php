<?php namespace Modules\Contabilidad\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContabilidadDatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		// Creando modulo de contabilidad
 		DB::table('modules')->insert([
 			['module_name' => 'Contabilidad']
 		]);
		$idContabilidad = DB::getPdo()->lastInsertId();
	
		DB::table('modules_permissions')->insert([
			[
				//ventas
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver ventas',
				'permission'    =>  'ventas.view'
			],
			[
				//pendientes
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver pendientes',
				'permission'    =>  'pendientes.view'
			],
			[
				//depositos
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver depositos',
				'permission'    =>  'depositos.view'
			],
			[
				//cancelaciones
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver cancelaciones',
				'permission'    =>  'cancelaciones.view'
			],
			[
				//polizas
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver polizas',
				'permission'    =>  'polizas.view'
			],
			[
				//antigüedad
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver antigüedad de saldos',
				'permission'    =>  'antiguedad.view'
			],
			[
				//auxiliar de movimientos
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver auxiliar de movimientos',
				'permission'    =>  'auxmovimientos.view'
			],
			[
				//estado de cuenta
				'module_id'    =>  $idContabilidad,
				'display_name'  =>  'Ver estado de cuenta',
				'permission'    =>  'estadocuenta.view'
			],
		]);	
	}

}