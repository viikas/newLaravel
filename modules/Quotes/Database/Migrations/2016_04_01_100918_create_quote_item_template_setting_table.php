<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteItemTemplateSettingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_item_template_setting', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
              $table->integer('quote_item_template_id_fk')->unsigned();
              $table->string('field_code',50);
              $table->string('field_name',100);
              $table->string('field_value',50);
              $table->string('acc_ref',20);
              $table->text('field_data_type',100);
            
            $table->foreign('quote_item_template_id_fk')->references('id')->on('quote_item_template')->onDelete('CASCADE')->onUpdate('CASCADE');

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
        Schema::drop('quote_item_template_setting');
    }

}
