<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeCuentasMenu extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$modulo = DB::table('modules')->where('module_name', 'Contabilidad')->get();
    	
        DB::table('modules_permissions')->insert([
			[
				//cuentas
				'module_id'    =>  $modulo[0]->id,
				'display_name'  =>  'Ver cuentas',
				'permission'    =>  'cuentas.view'
			],
			
		]);	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('');
    }

}
