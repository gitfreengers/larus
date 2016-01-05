<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRenameTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function(Blueprint $table)
        {
            $table->rename('contabilidad_sales');
        });
        
        Schema::table('sales_log', function(Blueprint $table)
        {
            $table->rename('contabilidad_sales_log');
        });
        
        Schema::table('payment_method', function(Blueprint $table)
        {
            $table->rename('contabilidad_payment_method');
        });
        
        Schema::table('place_user', function(Blueprint $table)
        {
            $table->rename('contabilidad_place_user');
        });
        
        Schema::table('depositos', function(Blueprint $table)
        {
            $table->rename('contabilidad_depositos');
        });
        
        Schema::table('deposito_aplicacion', function(Blueprint $table)
        {
            $table->rename('contabilidad_deposito_aplicacion');
        });
        
        
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
