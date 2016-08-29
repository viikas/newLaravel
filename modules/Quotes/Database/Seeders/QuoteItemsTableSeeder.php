<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteItemsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// Model::unguard();
		\DB::table('quote_items')->insert([
            [
                'quote_id' => '1',
                'item_number' => '1',
                'description' => 'D21  2 Leaves sliding doors with fly screen',
                'size' => '1.829 X 1.829 m',
                'quantity' => '1',
                'unit_price' => '40908.00',

                'total' => '40908.00',
                'total_material_cost' => '0.00',
                'total_fabrication_cost' => '0.00',
                'total_glass_cost' => '0.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_id' => '1',
                'item_number' => '2',
                'description' => 'w1 3 slide Windows with fly screen',
                'size' => '0.914 X 2133 m',
                'quantity' => '1',
                'unit_price' => '41983.00',

                'total' => '41983.00',
                'total_material_cost' => '0.00',
                'total_fabrication_cost' => '0.00',
                'total_glass_cost' => '0.00',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            
           ]);
		// $this->call("OthersTableSeeder");
	}

}