<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemNotesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_notes', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
             $table->integer('quote_id_fk')->unsigned();
              $table->text('note',500);
              $table->boolean('is_task_created');
              $table->string('created_by',50);
               $table->foreign('quote_id_fk')->references('id')->on('quote_quotes')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::drop('quote_item_notes');
    }

}
