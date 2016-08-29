<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductModelIdToQuoteTemplateTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_templates', function(Blueprint $table)
        {
            $table->integer('product_model_id')->unsigned()->after('code')->nullable()->default(null);
            $table->foreign('product_model_id')
                      ->references('id')->on('product_model');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_templates', function(Blueprint $table)
        {
            $table->dropColumn(['product_model_id']);
        });
    }

}
