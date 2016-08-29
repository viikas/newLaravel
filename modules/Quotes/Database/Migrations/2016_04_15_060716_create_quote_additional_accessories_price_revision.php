<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteAdditionalAccessoriesPriceRevision extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_additional_accessories_price_revision', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_additional_accessory_id')->unsigned();
            $table->double('revised_price');
            $table->datetime('effective_date');
            $table->date('deleted')->nullable();
            $table->string('user',50);
            $table->text('remark',200);
            $table->foreign('quote_additional_accessory_id','qt_add_access_id')->references('id')->on('quote_additional_accessories')->onDelete('CASCADE')->onUpdate('CASCADE');
           // $table->timestamps();
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
        Schema::drop('quote_additional_accessories_price_revision');
    }

}
