<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteGlassTypeThicknessTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_glass_type_thickness', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_glass_type_id_fk')->unsigned();
            $table->string('thickness');
            $table->timestamps();
            $table->foreign('quote_glass_type_id_fk')->references('id')->on('quote_glass_types')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_glass_type_thickness');
    }

}
