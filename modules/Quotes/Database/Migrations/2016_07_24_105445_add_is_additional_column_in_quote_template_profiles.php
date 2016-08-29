<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsAdditionalColumnInQuoteTemplateProfiles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_template_profiles', function(Blueprint $table)
        {   
            $table->boolean('is_additional')->nullable();
            $table->dropColumn('aluminium');
            $table->dropColumn('description');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_template_profiles', function(Blueprint $table)
        {

        });
    }

}
