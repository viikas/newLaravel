<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInQuoteItems extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_items', function(Blueprint $table)
        {
            $table->decimal('square_ft')->after('size');
            $table->decimal('glass_unit_cost')->after('unit_price');
            $table->decimal('total_cost_per_sqft')->after('total');
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
            $table->dropColumn('square_ft');
            $table->dropColumn('glass_unit_cost');
            $table->dropColumn('total_cost_per_sqft');
        });
    }

}
