<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToDepositosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contabilidad_depositos', function(Blueprint $table)
        {
			$table->string('tipo_pago')->after('fecha_cancelacion');
			$table->string('folio')->after('tipo_pago');
			$table->boolean('global')->after('folio')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contabilidad_depositos', function(Blueprint $table)
        {
			$table->dropColumn('folio');
			$table->dropColumn('tipo_pago');
			$table->dropColumn('global');

        });
    }

}
