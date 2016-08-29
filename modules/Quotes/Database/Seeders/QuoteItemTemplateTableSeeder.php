<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Model::unguard();
		\DB::table('quote_item_template')->insert([
            [
                'quote_item_id_fk' => '1',
                'template_code' => 'D21-1',
                'template_type' => 'type A',
                'material_cost' => '100.00',
                'fabrication_cost' => '50.00',
                'glass_cost' => '10.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_id_fk' => '1',
                'template_code' => 'D21-2',
                'template_type' => 'type A',
                'material_cost' => '150.00',
                'fabrication_cost' => '75.00',
                'glass_cost' => '15.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_id_fk' => '1',
                'template_code' => 'w1',
                'template_type' => 'type b',
                'material_cost' => '250.00',
                'fabrication_cost' => '75.00',
                'glass_cost' => '25.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_id_fk' => '2',
                'template_code' => 'D21',
                'template_type' => 'type A',
                'material_cost' => '150.00',
                'fabrication_cost' => '50.00',
                'glass_cost' => '10.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_id_fk' => '2',
                'template_code' => 'w1',
                'template_type' => 'type A',
                'material_cost' => '180.00',
                'fabrication_cost' => '55.00',
                'glass_cost' => '10.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
           ]);
		// $this->call("OthersTableSeeder");
	}

}