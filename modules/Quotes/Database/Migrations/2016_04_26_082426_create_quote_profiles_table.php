<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteProfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_profiles', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('color_type');
            $table->string('profile_color');
             $table->foreign('category_id')->references('id')->on('product_category');
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
        Schema::drop('quote_profiles');
    }

}
