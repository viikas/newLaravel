<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInQuoteActivityLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_activity_log', function(Blueprint $table)
        {
           $table->string('notes',1000);     
           $table->string('description',250)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_activity_log', function(Blueprint $table)
        {
            $table->dropColumn('notes');
            $table->text('description')->change();
        });
    }

}
