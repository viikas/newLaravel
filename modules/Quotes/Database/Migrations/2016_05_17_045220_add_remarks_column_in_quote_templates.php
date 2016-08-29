<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRemarksColumnInQuoteTemplates extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_templates', function(Blueprint $table)
        {
            $table->string('remarks',100)->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_templates', function(Blueprint $table)
        {
             $table->dropColumn('remarks');
        });
    }

}
