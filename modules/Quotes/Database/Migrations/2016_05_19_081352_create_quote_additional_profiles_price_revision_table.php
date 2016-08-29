<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAdditionalProfilesPriceRevisionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_additional_profiles_price_revision', function(Blueprint $table)
        {
           $table->increments('id')->unsigned();
            $table->integer('quote_additional_profile_id')->unsigned();
            $table->double('revised_price');
            $table->datetime('effective_date');
            $table->date('deleted')->nullable();
            $table->string('user',50);
            $table->text('remark',200);
            $table->foreign('quote_additional_profile_id','qt_add_prof_id')->references('id')->on('quote_additional_profile')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->date('created_at');
            $table->date('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_additional_profiles_price_revision');
    }

}

