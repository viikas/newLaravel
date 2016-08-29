<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteBoardTypesThicknessSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('quote_board_type_thickness')->insert([
          	[

'quote_board_type_id_fk'=>'1',
'thickness'=>'9mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
],
 	[

'quote_board_type_id_fk'=>'1',
'thickness'=>'12mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'2',
'thickness'=>'',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'3',
'thickness'=>'6mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'3',
'thickness'=>'3mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'3',
'thickness'=>'4mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'4',
'thickness'=>'5mm',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

],
 	[

'quote_board_type_id_fk'=>'5',
'thickness'=>'',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,24)->toDateTimeString(),

]

          	]);
	}

}