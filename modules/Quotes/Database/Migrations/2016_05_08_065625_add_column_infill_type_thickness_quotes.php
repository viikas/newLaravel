<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInfillTypeThicknessQuotes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quote_quotes', function(Blueprint $table)
        {
            $table->renameColumn('glass_type_id_fk','infill_type_id_fk');
            $table->integer('infill_thickness_id_fk')->after('glass_type_id_fk');
            $table->decimal('total_unforeseen')->after('pc_glass_wastage');
            $table->decimal('total_engg_mgmt')->after('pc_glass_wastage');
            $table->decimal('total_markup')->after('pc_glass_wastage');
            $table->decimal('glass_total_markups')->after('pc_glass_wastage');
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
            $table->renameColumn('infill_type_id_fk','glass_type_id_fk');
            $table->dropColumn('infill_thickness_id_fk');            
            $table->dropColumn('total_unforeseen');
            $table->dropColumn('total_engg_mgmt');
            $table->dropColumn('total_markup');
            $table->dropColumn('glass_total_markups');
        });
    }

}
