<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesPermissionsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules_permissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->string('display_name');
            $table->string('permission');
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
        Schema::drop('modules_permissions');
    }

}
