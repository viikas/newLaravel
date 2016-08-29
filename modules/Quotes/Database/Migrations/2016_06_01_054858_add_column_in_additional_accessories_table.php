<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInAdditionalAccessoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_additional_accessories', function(Blueprint $table)
        {
            $table->boolean('is_length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_additional_accessories', function(Blueprint $table)
        {
             $table->dropColumn('is_length');
        });
    }

}
