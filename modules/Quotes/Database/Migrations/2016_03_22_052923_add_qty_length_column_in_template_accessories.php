<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQtyLengthColumnInTemplateAccessories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_template_accessories', function(Blueprint $table)
        {
            $table->integer('qty_length');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_template_accessories', function(Blueprint $table)
        {
            $table->dropColumn('qty_length');
        });
    }

}
