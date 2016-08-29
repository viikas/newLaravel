<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_items', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
              $table->integer('quote_id')->unsigned();
            $table->integer('item_number');
            $table->text('description',500);
            $table->string('size',50);
            $table->integer('quantity');
            $table->decimal('unit_price');
            $table->decimal('total');
            $table->decimal('total_material_cost');
            $table->decimal('total_fabrication_cost');
            $table->decimal('total_glass_cost');
              $table->foreign('quote_id')->references('id')->on('quote_quotes')->onDelete('cascade');
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
        Schema::drop('quote_items');
    }

}
