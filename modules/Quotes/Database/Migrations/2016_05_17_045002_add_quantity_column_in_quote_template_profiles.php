<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQuantityColumnInQuoteTemplateProfiles extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_template_profiles', function(Blueprint $table)
        {
             $table->integer('quantity')->after('profile_id_fk');
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
            $table->dropColumn('quantity');
        });
    }

}
