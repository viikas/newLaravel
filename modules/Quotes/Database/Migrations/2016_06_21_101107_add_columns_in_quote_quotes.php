<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInQuoteQuotes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_quotes', function(Blueprint $table)
        {
            $table->integer('wind_pressure');
            $table->tinyInteger('rem_pay_1');
            $table->tinyInteger('rem_pay_2');
            $table->tinyInteger('rem_pay_3');
            $table->tinyInteger('rem_pay_4');
            $table->tinyInteger('rem_pay_5');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_quotes', function(Blueprint $table)
        {

            $table->dropColumn('wind_pressure');
            $table->dropColumn('rem_pay_1');
            $table->dropColumn('rem_pay_2');
            $table->dropColumn('rem_pay_3');
            $table->dropColumn('rem_pay_4');
            $table->dropColumn('rem_pay_5');
        });
    }

}
