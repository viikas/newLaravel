<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteQuotesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_quotes', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('opportunity_id_fk')->unsigned();
            $table->integer('quote_number');
            $table->char('quote_option',1);
            $table->integer('revision_number');
            $table->text('title',200);
            $table->text('remarks',500);
            $table->integer('quote_status_id_fk')->unsigned();
            $table->decimal('total_material_cost');
            $table->decimal('total_fabric_install_cost');
            $table->decimal('total_glass_cost');
            $table->decimal('pc_unforseen');
            $table->decimal('pc_engg_mgmt');
            $table->decimal('pc_markup');
            $table->decimal('pc_glass_markup');
            $table->decimal('pc_glass_wastage');
            $table->boolean('is_include_vat');
            $table->decimal('sub_total');
            $table->decimal('discount');
            $table->decimal('pc_discount');
            $table->decimal('sub_total_discounted');
            $table->decimal('vat');
            $table->decimal('grand_total');
            $table->string('created_by',50);
            $table->string('updated_by',50);
            $table->string('deleted_by',50)->nullable()->default('NULL');
            $table->string('deleated_at')->nullable()->default('NULL');
             //$table->foreign('opportunity_id_fk')->references('id')->on('opportunity')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('quote_quotes');
    }

}
