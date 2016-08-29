<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDescriptionQuoteTemplateAccessories extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_template_accessories', function(Blueprint $table)
        {
            $table->string('acc_ref');
            $table->string('description');
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

            $table->dropColumn('acc_ref');
            $table->dropColumn('description');
        });
    }

}
