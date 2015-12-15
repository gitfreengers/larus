<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tasks', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('user_complete_id')->unsigned()->nullable();
            $table->timestamp('time_complete')->nullable();


            $table->string('title');
            $table->text('description');

            $table->timestamp('start_time')->nullable();
            $table->timestamp('expire_time')->nullable();

            $table->text('read')->nullable();
            $table->text('status')->nullable();
            $table->integer('process')->default(0);




            // references
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('role_id')->references('id')
                ->on('roles');
            $table->foreign('user_complete_id')->references('id')
                ->on('users');







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
		Schema::drop('tasks');
	}

}
