<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEstatusToDepositoAplicationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::drop('deposito_aplicacion');
    	
        Schema::create('deposito_aplicacion', function(Blueprint $table)
        {
        	$table->integer('deposito_id')->unsigned();
        	$table->foreign('deposito_id')->references('id')->on('depositos')->onDelete('cascade');
        		
        	$table->integer('venta_id')->unsigned();
        	$table->foreign('venta_id')->references('id')->on('sales')->onDelete('cascade');
        		
			$table->smallInteger('estatus');
			
        	$table->integer('usuario_id')->unsigned();
        	$table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        	 
        	$table->double('cantidad');
        	 
        	$table->timestamps();
        	
        	$table->primary(['deposito_id','venta_id', 'estatus']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposito_aplication', function(Blueprint $table)
        {
			$table->dropColumn('estatus');

        });
    }

}
