<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInQuotesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_quotes', function(Blueprint $table)
        {
            $table->integer('product_category_id_fk')->after('grand_total');
            $table->boolean('is_glass')->after('product_category_id_fk');
            $table->integer('glass_type_id_fk')->after('is_glass');
            $table->renameColumn('deleated_at','deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quote_quotes', function(Blueprint $table)
        {
            $table->dropColumn(['product_category_id_fk','is_glass','glass_type_id_fk']);
            $table->renameColumn('deleted_at','deleated_at');
        });
    }

}
