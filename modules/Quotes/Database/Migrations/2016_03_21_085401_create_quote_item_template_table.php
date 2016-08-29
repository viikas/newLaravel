<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTemplateTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_template', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
             $table->integer('quote_item_id_fk')->unsigned();
           $table->string('template_code');
             $table->string('template_type');
              $table->decimal('material_cost');
             $table->decimal('fabrication_cost');
             $table->decimal('glass_cost');
             $table->foreign('quote_item_id_fk')->references('id')->on('quote_items')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_item_template');
    }

}
