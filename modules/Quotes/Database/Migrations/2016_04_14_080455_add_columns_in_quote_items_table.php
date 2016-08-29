<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInQuoteItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_items', function(Blueprint $table)
        {
              $table->boolean('is_optional');
              $table->string('client_reference_code',50);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_items', function(Blueprint $table)
        {
             $table->dropColumn('is_optional');
              $table->dropColumn('client_reference_code');
        });
    }

}
