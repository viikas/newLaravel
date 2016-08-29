<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInQuoteItemTemplateAccessoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_item_template_accessories', function(Blueprint $table)
        {
            $table->boolean('acc_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_item_template_accessories', function(Blueprint $table)
        {
            $table->dropColumn('acc_type');
        });
    }

}
