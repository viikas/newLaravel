<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTemplateAccessoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_template_accessories', function(Blueprint $table)
        {
            $table->increments('id');
			$table->integer('quote_template_id_fk');
			$table->integer('accessory_id_fk');
			$table->string('formula',50);
			$table->boolean('is_roller');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_template_accessories');
    }

}
