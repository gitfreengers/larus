<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteUserTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_user', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('note_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('note_user');
    }

}
