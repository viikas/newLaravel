<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInActivityLogTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_activity_log', function(Blueprint $table)
        {
            $table->string('category',50);
            $table->integer('category_id');
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
            $table->dropColumn(['category','category_id']);
        });
    }

}
