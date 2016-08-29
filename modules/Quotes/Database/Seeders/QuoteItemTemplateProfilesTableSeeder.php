<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateProfilesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		\DB::table('quote_item_template_profiles')->insert([
            [
                'quote_item_template_id_fk' => '1',
                'aluminium' => 'Al 1',
                'description' => 'Desc of Al 1',
                'formula' => '2l * h',
                'qty_length' => '5.00',
                'kg_meter' => '5.75',
                'amount' => '175.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '1',
                'aluminium' => 'Al 2',
                'description' => 'Desc of Al 2',
                'formula' => '2l * h',
                'qty_length' => '15.00',
                'kg_meter' => '5.25',
                'amount' => '275.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '2',
                'aluminium' => 'Al A',
                'description' => 'Desc of Al A',
                'formula' => '2l * h',
                'qty_length' => '10.00',
                'kg_meter' => '5.00',
                'amount' => '205.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '3',
                'aluminium' => 'Al X',
                'description' => 'Desc of Al X',
                'formula' => '2l * h',
                'qty_length' => '5.00',
                'kg_meter' => '5.75',
                'amount' => '175.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '3',
                'aluminium' => 'Al Y',
                'description' => 'Desc of Al Y',
                'formula' => '2l * h',
                'qty_length' => '12.00',
                'kg_meter' => '5.75',
                'amount' => '212.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '4',
                'aluminium' => 'Al A-1',
                'description' => 'Desc of Al A-1',
                'formula' => '2l * h',
                'qty_length' => '5.00',
                'kg_meter' => '5.75',
                'amount' => '175.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '5',
                'aluminium' => 'Al 5A',
                'description' => 'Desc of Al 5A',
                'formula' => '2l * h',
                'qty_length' => '5.00',
                'kg_meter' => '5.75',
                'amount' => '175.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '5',
                'aluminium' => 'Al 5-A',
                'description' => 'Desc of Al 5-A',
                'formula' => '2l * h',
                'qty_length' => '5.00',
                'kg_meter' => '5.75',
                'amount' => '175.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
           ]);
		// $this->call("OthersTableSeeder");
	}

}