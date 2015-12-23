<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOpLocationClLocationToSalesLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_log', function(Blueprint $table)
        {
			$table->string('op_location')->after('description');
			$table->string('cl_location')->after('op_location');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_log', function(Blueprint $table)
        {
			$table->dropColumn('op_location');
			$table->dropColumn('cl_location');

        });
    }

}
