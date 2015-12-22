<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmmountAppliedColumnToSalesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function(Blueprint $table)
        {
			$table->double('ammount_applied')->after('ammount')->default(0);
        }); 
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function(Blueprint $table)
        {
			$table->dropColumn('ammount_applied');
        });
    }

}
