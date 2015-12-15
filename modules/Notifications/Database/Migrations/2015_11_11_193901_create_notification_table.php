<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->nullable();
            $table->string('name');
            $table->text('description');
            $table->string('url');
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
        });

        // Create table for associating notification to users (Many-to-Many)
        Schema::create('notification_user',function(Blueprint $table){
            $table->integer('notification_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('active')->default(0);
            // references
            $table->foreign('notification_id')->references('id')->on('notification')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['notification_id','user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('notification_user');
        Schema::drop('notification');
    }

}
