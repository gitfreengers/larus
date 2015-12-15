<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alerts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('task_id')->unsigned();
            $table->string('title');
            $table->string('description');
            $table->string('url');
            $table->text('alert_display')->nullable();

			$table->timestamps();


            // references
            $table->foreign('task_id')->references('id')
                ->on('tasks')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alerts');
	}

}
