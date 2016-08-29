<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteGlassTypesSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Model::unguard();
		\DB::table('quote_glass_types')->truncate();
		\DB::table('quote_glass_types')->insert([
          	[

'name'=>'Anneled glass',
'parent_id'=>null,
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Clear Float Glasss',
'parent_id'=>'1',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

[

'name'=>'Tinted glass',
'parent_id'=>'1',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Reflective glass',
'parent_id'=>'1',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Figure glass',
'parent_id'=>'1',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Frosted glass',
'parent_id'=>'1',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Toughened glass',
'parent_id'=>null,
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Clear toughened Glass',
'parent_id'=>'7',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Tinted Glass',
'parent_id'=>'7',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Reflective Glass',
'parent_id'=>'7',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Frosted Glass',
'parent_id'=>'7',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Laminated Glass',
'parent_id'=>null,
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Hardened Clear Glass',
'parent_id'=>'12',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Hardened Tinted Glass',
'parent_id'=>'12',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Hardened Reflective Glass',
'parent_id'=>'12',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Hardened Frosted Glass',
'parent_id'=>'12',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Normal Clear Glass',
'parent_id'=>'12',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Double glazed glass',
'parent_id'=>null,
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Clear toughened Glass',
'parent_id'=>'18',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Tinted Glass',
'parent_id'=>'18',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Reflective Glass',
'parent_id'=>'18',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'name'=>'Frosted Glass',
'parent_id'=>'4',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
]

]);
		// $this->call("OthersTableSeeder");
	}

}