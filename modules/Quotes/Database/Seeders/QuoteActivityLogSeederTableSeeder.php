<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteActivityLogSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('quote_activity_log')->insert([
          	[

'log_type'=>'Quote created',
'description'=>'this is description',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

	[

'log_type'=>'Status change',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

[

'log_type'=>'Assigned to',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

[

'log_type'=>'Line item added',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'optional item added',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'line item deleted',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'optional item deleted',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

[

'log_type'=>'line item updated',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'optional item updated',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'discount provided',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],


[

'log_type'=>'markup adjusted',
'description'=>'this is description ',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
]





	

          	]);
	}

}