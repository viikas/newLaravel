<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTemplatesTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_templates', function(Blueprint $table)
        {
            $table->increments('id');
             $table->string('code', 10);
             $table->text('description',200);
             $table->string('image',256)->nullable()->default('NULL');
             $table->string('type',10);
             $table->string('created_by',50);
             $table->string('updated_by',50);
             $table->string('deleted_by',50)->nullable();
             $table->timestamp('deleted_at')->nullable();
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
        Schema::drop('quote_templates');
    }

}
