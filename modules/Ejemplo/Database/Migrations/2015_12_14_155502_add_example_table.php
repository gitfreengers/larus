<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Modules\Ejemplo\Entities\Example;

class AddExampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $example = new Example([
        	'user_id'=>'1',
        	'completed'=>true,
        	'todo'=>'ejemplo1'
        ]);
        $example->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
