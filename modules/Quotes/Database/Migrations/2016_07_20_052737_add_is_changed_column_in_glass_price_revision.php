<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsChangedColumnInGlassPriceRevision extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_glass_price_revision', function(Blueprint $table)
        {
             $table->boolean('is_changed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_glass_price_revision', function(Blueprint $table)
        {
            $table->dropColumn('is_changed');
        });
    }

}
