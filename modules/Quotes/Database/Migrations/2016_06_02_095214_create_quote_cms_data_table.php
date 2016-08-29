<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteCmsDataTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_cms_data', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('quote_id')->unsigned();
            $table->string('cms_code',50);
            $table->text('field_value');
            $table->foreign('quote_id')->references('id')->on('quote_quotes')->onDelete('CASCADE')->onUpdate('CASCADE');
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_cms_data');
    }

}
