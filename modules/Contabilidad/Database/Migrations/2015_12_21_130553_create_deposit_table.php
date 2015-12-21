<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depositos', function(Blueprint $table)
        {
            $table->increments('id');
			$table->string('banco');
			$table->date('fecha');
			$table->string('referencia');
			$table->double('monto');
			$table->smallInteger('moneda');
			$table->string('cuenta_contable');
			$table->string('complementaria');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('depositos');
    }

}
