<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteActivityLog extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_activity_log', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('log_type',50);
            $table->text('description',200);
            $table->string('created_by',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_activity_log');
    }

}
