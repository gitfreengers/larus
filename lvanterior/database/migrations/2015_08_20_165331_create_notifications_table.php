<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function(Blueprint $table)
		{
			$table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('role_id')->unsigned()->nullable();



            $table->string('title');
            $table->text('description');
            $table->string('url');

            $table->text('read')->nullable();
            $table->text('status')->nullable();


			$table->timestamps();



            // references
            $table->foreign('user_id')->references('id')
                ->on('users');
            $table->foreign('role_id')->references('id')
                ->on('roles');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('notifications');
	}

}
