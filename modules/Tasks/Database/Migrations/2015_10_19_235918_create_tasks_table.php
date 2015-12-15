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
        // create table for tasks
        Schema::create('flows', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('module')->nullable()->index();
            $table->boolean('active')->default(0)->index();
            $table->timestamps();

        });

        Schema::create('flows_steps', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('flow_id')->unsigned();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('order')->default(1)->index();
            $table->boolean('is_last')->default(0)->index();
            $table->timestamps();
            $table->foreign('flow_id')->references('id')->on('flows')->onDelete('cascade');
        });
        Schema::create('flows_steps_transitions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('flow_id')->unsigned();
            $table->integer('step_from_id')->unsigned();
            $table->integer('step_to_id')->unsigned();
            $table->timestamps();
            $table->foreign('flow_id')->references('id')->on('flows')->onDelete('cascade');
            $table->foreign('step_from_id')->references('id')->on('flows_steps')->onDelete('cascade');
            $table->foreign('step_to_id')->references('id')->on('flows_steps')->onDelete('cascade');
        });


        // create table for tasks
        Schema::create('tasks', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('flow_id')->unsigned();

            $table->string('name');
            $table->text('description');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('due_date')->nullable();

            $table->string('status');
            $table->integer('progress');
            $table->integer('user_id_done')->unsigned()->nullable();
            $table->timestamp('done_date')->nullable();
            // references
            $table->foreign('flow_id')->references('id')->on('flows')->onDelete('cascade');;
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');;
            $table->foreign('user_id_done')->references('id')->on('users');


            $table->timestamps();
        });

        // Create table for associating tasks to users (Many-to-Many)
        Schema::create('task_user',function(Blueprint $table){
            $table->integer('task_id')->unsigned();
            $table->integer('user_id')->unsigned();
            // references
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['task_id','user_id']);

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       /* Schema::drop('flows_steps_transitions');
        Schema::drop('flows_steps');*/
        Schema::drop('task_user');
        Schema::drop('tasks');
        Schema::drop('flows');


    }

}
