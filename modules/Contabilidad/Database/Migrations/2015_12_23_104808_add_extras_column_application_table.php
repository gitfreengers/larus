<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtrasColumnApplicationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('depositos', function(Blueprint $table)
        {
			$table->smallinteger('estatus')->after('usuario_id');
			$table->integer('usuario_cancelacion_id')->after('estatus');
			$table->date('fecha_cancelacion')->after('usuario_cancelacion_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('depositos', function(Blueprint $table)
        {
			$table->dropColumn('estatus');
			$table->dropColumn('usuario_cancelacion_id');
			$table->dropColumn('fecha_cancelacion');

        });
    }

}
