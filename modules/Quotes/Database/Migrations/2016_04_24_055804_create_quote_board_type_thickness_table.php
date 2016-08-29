<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteBoardTypeThicknessTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_board_type_thickness', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_board_type_id_fk')->unsigned();
            $table->string('thickness');
            $table->foreign('quote_board_type_id_fk')->references('id')->on('quote_board_types')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_board_type_thickness');
    }

}
