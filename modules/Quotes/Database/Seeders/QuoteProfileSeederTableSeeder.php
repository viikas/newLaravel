<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteProfileSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('quote_profiles')->insert([
            [
                'category_id' => '3',
                'color_type' => 'anodised',
                'profile_color' => 'Natural',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
              [
                'category_id' => '3',
                'color_type' => 'anodised',
                'profile_color' => 'Black',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'anodised',
                'profile_color' => 'Champagne',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'powder-coated',
                'profile_color' => 'Solid-Dark Brown(MN12223)',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'powder-coated',
                'profile_color' => 'Solid_Light Brown(MN02979)',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'powder-coated',
                'profile_color' => 'Solid-White(MN02930)',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'powder-coated',
                'profile_color' => 'Texture Colors',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ],
  [
                'category_id' => '3',
                'color_type' => 'ral-color',
                'profile_color' => 'RAL color',
                
                'created_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 4, 26)->toDateTimeString(),
                 
            ]
             ]);
		
	}

}