<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemImagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_images', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_item_id')->unsigned();
            $table->string('filename');
            $table->decimal('filesize');
            $table->string('created_by');    
            $table->foreign('quote_item_id')->references('id')->on('quote_items')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_item_images');
    }

}
