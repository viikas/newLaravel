<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteStatusTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		\DB::table('quote_statuses')->insert([
          	[

'status_code'=>'assigned',
'status_name'=>'Assigned',
'remarks'=>'Random remarks',
],

[

'status_code'=>'draft',
'status_name'=>'Draft',
'remarks'=>'Random remarks',
],
[

'status_code'=>'ready',
'status_name'=>'Ready',
'remarks'=>'Random remarks',
],
[

'status_code'=>'delivered',
'status_name'=>'Delivered',
'remarks'=>'Random remarks',
],
[

'status_code'=>'accepted',
'status_name'=>'Accepted',
'remarks'=>'Random remarks',
],
[

'status_code'=>'rejeccted',
'status_name'=>'Rejected',
'remarks'=>'Random remarks',
],
[

'status_code'=>'cancelled',
'status_name'=>'Cancelled',
'remarks'=>'Random remarks',
]


]);
		// $this->call("OthersTableSeeder");
	}

}