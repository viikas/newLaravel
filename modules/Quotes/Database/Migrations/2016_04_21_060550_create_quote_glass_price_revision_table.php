<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteGlassPriceRevisionTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_glass_price_revision', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_glass_type_thickness_id_fk')->unsigned();
            $table->decimal('inventory_price');
            $table->decimal('revised_price');
            $table->date('effective_date');
            $table->date('deleted')->nullable();
            $table->string('user');
            $table->text('remark',200);
            $table->date('created_at');
            $table->date('updated_at');
               $table->foreign('quote_glass_type_thickness_id_fk','qt_gls_typ_thk_id')->references('id')->on('quote_glass_type_thickness')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_glass_price_revision');
    }

}
