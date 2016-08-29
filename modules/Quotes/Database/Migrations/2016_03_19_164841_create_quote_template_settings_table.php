<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTemplateSettingsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_template_settings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quote_template_id_fk');
            $table->string('field_code',50);
            $table->string('field_name',100);
            $table->string('field_value',50);
            $table->string('field_data_type',10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_template_settings');
    }

}
