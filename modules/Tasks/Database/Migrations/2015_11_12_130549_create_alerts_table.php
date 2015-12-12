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
            $table->timestamps();


            // references
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
        // Create table for associating notification to users (Many-to-Many)
        Schema::create('alert_user',function(Blueprint $table){
            $table->integer('alert_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('read')->default(0);

            // references
            $table->foreign('alert_id')->references('id')->on('alerts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['alert_id','user_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('alert_user');
        Schema::drop('alerts');
    }

}
