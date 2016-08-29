<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTemplateProfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_template_profiles', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
               $table->integer('quote_item_template_id_fk')->unsigned();
              $table->string('aluminium',50);
              $table->string('description',100);
              $table->string('formula',50);
              $table->decimal('qty_length');
              $table->decimal('kg_meter');
              $table->decimal('amount');
               $table->foreign('quote_item_template_id_fk')->references('id')->on('quote_item_template')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::drop('quote_item_template_profiles');
    }

}
