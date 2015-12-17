<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function(Blueprint $table)
        {
            $table->increments('id');
            
			$table->integer('transaction_id');
			$table->string('reference')->nullable();		
			$table->date('ra_start_date');
			$table->date('ra_end_date');
			$table->string('factura_uuid');
			$table->double('ammount');
			$table->string('credit_debit');
			$table->string('payment_method');
			$table->double('ra_total');
			$table->integer('customer_number');
			$table->string('op_location');
			$table->string('cl_location');
			$table->bigInteger('gl_account', false, true);
			$table->string('concept');
			$table->string('description');
			$table->date('date');
			$table->string('factura_number');
				
            $table->timestamps();
        });
        
        Schema::create('sales_log', function(Blueprint $table)
        {
            $table->increments('id');
			$table->string('file_name');
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
        Schema::drop('sales');
        Schema::drop('sales_log');
    }

}
