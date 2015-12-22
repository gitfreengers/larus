<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Contabilidad\Entities\Sales;

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
			$table->double('ammount_applied')->after('ammount');
        }); 
        
        $sales = Sales::all();
        foreach ($sales as $sale){
        	$sale->ammount_applied = $sale->ammount;
        	$sale->update();
        }
        
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
