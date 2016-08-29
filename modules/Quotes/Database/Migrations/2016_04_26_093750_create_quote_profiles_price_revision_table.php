<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteProfilesPriceRevisionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_profiles_price_revision', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_profile_id')->unsigned();
            $table->decimal('revised_price');
            $table->decimal('inventory_price');
            $table->date('effective_date');
            $table->date('deleted')->nullable();
            $table->string('user',50);
            $table->text('remarks',200);
            $table->date('created_at');
            $table->date('updated_at');
              $table->foreign('quote_profile_id')->references('id')->on('quote_profiles')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_profiles_price_revision');
    }

}
