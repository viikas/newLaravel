<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteProductPriceRevisionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_product_price_revision', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id');
            $table->double('invent_price')->nullable();
            $table->double('revised_price')->nullable();
              $table->date('effective_date')->nullable();
             $table->date('deleted')->nullable();
             $table->string('user')->nullable();
             $table->text('remark')->nullable();
              $table->foreign('product_id')->references('id')->on('invent_accessory')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_product_price_revision');
    }

}
