<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteBoardPriceRevisionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_board_price_revision', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_board_type_thickness_id_fk')->unsigned();
            $table->decimal('revised_price');
            $table->decimal('inventory_price');
            $table->date('effective_date');
            $table->date('deleted')->nullable();
            $table->string('user');
            $table->text('remark');
            $table->foreign('quote_board_type_thickness_id_fk','qt_brd_typ_thk_id')->references('id')->on('quote_board_type_thickness')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_board_price_revision');
    }

}
