<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAdditionalProfileTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_additional_profile', function(Blueprint $table)
        {
              $table->increments('id')->unsigned();
              $table->string('profile_category_name',50);
              $table->string('number',50);
              $table->string('profile_name',100);
              $table->string('weight');
              $table->string('thickness');
              $table->text('notes',200);
             
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
        Schema::drop('quote_additional_profile');
    }

}
