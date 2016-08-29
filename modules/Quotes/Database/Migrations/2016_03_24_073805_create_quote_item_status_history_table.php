<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemStatusHistoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_status_history', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_id_fk')->unsigned();
            $table->integer('quote_status_id_fk')->unsigned();
              $table->text('remarks',200);
             $table->string('created_by',50);
             $table->string('assigned_to',50);
           $table->foreign('quote_id_fk')->references('id')->on('quote_quotes')->onDelete('CASCADE')->onUpdate('CASCADE');
           $table->foreign('quote_status_id_fk')->references('id')->on('quote_statuses')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::drop('quote_item_status_history');
    }

}
