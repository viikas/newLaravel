<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteCmsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_cms', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('cms_code');
            $table->text('description',200);
            $table->string('remarks',200);
            $table->string('field_value',50);
            $table->string('category',50);
            $table->string('field_type',50);
            $table->integer('length');
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
        Schema::drop('quote_cms');
    }

}
