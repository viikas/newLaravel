<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteTemplateProfilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_template_profiles', function(Blueprint $table)
        {
            $table->increments('id');
			$table->integer('quote_template_id_fk');
			$table->integer('profile_id_fk');
			$table->string('formula',50);
                        $table->boolean('is_fly_screen');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quote_template_profiles');
    }

}
