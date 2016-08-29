<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTemplateInfillingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_template_infilling', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_item_template_id_fk')->unsigned();
            $table->boolean('is_fixed');
            $table->integer('panel_count');
            $table->string('length_formula');
            $table->string('height_formula');
            $table->double('length_mm');
            $table->double('height_mm');
            $table->double('infill_area_sqft');
            $table->double('actual_infill_area');
            $table->double('bible_suggested');
            $table->boolean('is_glass');
            $table->integer('infill_type_id_fk');
            $table->integer('infill_thickness_id_fk');
            $table->double('infill_unit_cost');
            $table->double('infill_total_cost');
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
        Schema::drop('quote_item_template_infilling');
    }

}
