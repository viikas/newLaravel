<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTemplateAccessoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_template_accessories', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
              $table->integer('quote_item_template_id_fk')->unsigned();
              $table->string('acc_ref',20);
              $table->string('description',100);
              $table->string('formula',50);
              $table->decimal('qty_length');
              $table->decimal('mu_cost_rs');
              $table->decimal('total_price');
               $table->foreign('quote_item_template_id_fk','qt_itm_tmp_id_fk')->references('id')->on('quote_item_template')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::drop('quote_item_template_accessories');
    }

}
