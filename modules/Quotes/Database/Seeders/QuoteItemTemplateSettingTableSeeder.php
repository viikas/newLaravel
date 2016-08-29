<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateSettingTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		\DB::table('quote_item_template_setting')->insert([
            [
                'quote_item_template_id_fk' => '1',
                'field_code' => 'code_a',
                'field_name' => 'Code A',
                'field_value' => 'Value of A',
                'acc_ref' => '1000',
                'field_data_type' => 'test',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '1',
                'field_code' => 'code_b',
                'field_name' => 'Code B',
                'field_value' => 'Value of B',
                'acc_ref' => '1001',
                'field_data_type' => 'test',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '2',
                'field_code' => 'code_x',
                'field_name' => 'Code X',
                'field_value' => 'Value of X',
                'acc_ref' => '1002',
                'field_data_type' => 'test',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '2',
                'field_code' => 'code_y',
                'field_name' => 'Code Y',
                'field_value' => 'Value of Y',
                'acc_ref' => '1003',
                'field_data_type' => 'test',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '3',
                'field_code' => 'code_z',
                'field_name' => 'Code Z',
                'field_value' => 'Value of Z',
                'acc_ref' => '1004',
                'field_data_type' => 'test',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
           ]);
		// $this->call("OthersTableSeeder");
	}

}