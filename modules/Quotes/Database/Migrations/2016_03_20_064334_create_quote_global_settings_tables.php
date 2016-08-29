<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteGlobalSettingsTables extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_global_settings', function(Blueprint $table)
        {
            $table->increments('id');
             $table->string('field_code', 20);
             $table->text('field_name',200);
             $table->string('field_value',50);
             $table->string('field_data_type',10);
              $table->text('remark',200)->nullable();
              $table->string('setting_type',20);
              $table->string('created_by',50);
              $table->string('updated_by',50);
              $table->string('deleted_by',50)->nullablle();
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
        Schema::drop('quote_global_settings');
    }

}
