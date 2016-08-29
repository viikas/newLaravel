<?php

namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteTemplateSettingTableSeeder extends Seeder {

    public function run() {
        \DB::table('quote_template_settings')->insert([
            [
                'quote_template_id_fk' => '1',
                'field_code' => 'alu_waste_pc',
                'field_name' => 'Alu. % Waste',
                'field_value' => '10',
                'field_data_type'=>'decimal'
            ],
            [
                'quote_template_id_fk' => '1',
                'field_code' => 'length',
                'field_name' => 'Length',
                'field_value' => '1.0000',
                'field_data_type'=>'decimal'
            ],
            [
                'quote_template_id_fk' => '1',
                'field_code' => 'height',
                'field_name' => 'Height',
                'field_value' => '1.5000',
                'field_data_type'=>'decimal'
            ],
            [
                'quote_template_id_fk' => '1',
                'field_code' => 'fly_screen',
                'field_name' => 'Fly Screen',
                'field_value' => '1',
                'field_data_type'=>'boolean'
            ],
            [
                'quote_template_id_fk' => '1',
                'field_code' => 'square_ft',
                'field_name' => 'Sqft',
                'field_value' => '16.15',
                'field_data_type'=>'decimal'
            ]
        ]);
    }

}
