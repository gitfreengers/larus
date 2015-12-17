<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProcessRowsToSalesLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_log', function(Blueprint $table)
        {
			$table->integer('process')->after('file_name');

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
			$table->dropColumn('process');

        });
    }

}
