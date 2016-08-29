<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTemplateInfillingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_template_infilling', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_template_id_fk')->unsigned();
            $table->boolean('is_fixed');
            $table->integer('panel_count');
            $table->string('length_formula');
            $table->string('height_formula');
            $table->double('length_mm');
            $table->double('height_mm');
            $table->foreign('quote_template_id_fk')->references('id')->on('quote_templates')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_template_infilling');
    }

}
