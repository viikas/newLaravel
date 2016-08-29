<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAdditionalAccessoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_additional_accessories', function(Blueprint $table)
        {
           $table->increments('id')->unsigned();
              $table->string('accessory_category_name',50);
              $table->string('accessory_code',50);
              $table->string('accessory_name',100);
              $table->text('remarks',200);
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
        Schema::drop('quote_additional_accessories');
    }

}
