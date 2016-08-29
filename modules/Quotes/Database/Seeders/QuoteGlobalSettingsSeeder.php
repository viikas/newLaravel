<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteGlobalSettingsSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 \DB::table('quote_global_settings')->truncate();
		\DB::table('quote_global_settings')->insert([
          	[

'field_code'=>'manpower_cost',
'field_name'=>'Fabrication Cost',
'field_value'=>'1500',
'field_data_type'=>'money',
'remark'=>'For manpower cost',
'setting_type'=>'template',
'created_by'=>'Ram',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'deleted_at'=>\Carbon\Carbon::createFromDate(2016,3,30)->toDateTimeString(),
'updated_by'=>'Ram',
'deleted_by'=>'Ram',
],

        	[

'field_code'=>'email_from',
'field_name'=>'Sender Email',
'field_value'=>'info@skylight.com',
'field_data_type'=>'string',
'remark'=>'Email sender address',
'setting_type'=>'email',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'deleted_at'=>'NULL',
'created_by'=>'Ram',
'updated_by'=>'Ram',
'deleted_by'=>'NULL',


],

	[

'field_code'=>'admin_email',
'field_name'=>'Admin email',
'field_value'=>'admin@skylight.com',
'field_data_type'=>'string',
'remark'=>'Administrators email',
'setting_type'=>'email',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'deleted_at'=>\Carbon\Carbon::createFromDate(2016,3,30)->toDateTimeString(),
'created_by'=>'Ram',
'updated_by'=>'Ram',
'deleted_by'=>'Ram',

],
[

'field_code'=>'aluminium_wastage',
'field_name'=>'Aluminium % Wastage',
'field_value'=>'10',
'field_data_type'=>'decimal',
'remark'=>'Random remark',
'setting_type'=>'template',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),

'created_by'=>'Ram',
'updated_by'=>'Ram',

'deleted_at'=>'NULL',
'deleted_by'=>'NULL',

],

[

'field_code'=>'accessories_wastage',
'field_name'=>'Accessories % Wastage',
'field_value'=>'2.5',
'field_data_type'=>'decimal',
'remark'=>'Random remark',
'setting_type'=>'template',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),

'created_by'=>'Shyam',
'updated_by'=>'Shyam',
'deleted_at'=>'NULL',
'deleted_by'=>'NULL',

],

[

'field_code'=>'glass_wastage_pc',
'field_name'=>'glass % Wastage',
'field_value'=>'2.5',
'field_data_type'=>'decimal',
'remark'=>'Random remark',
'setting_type'=>'template',
'created_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,3,17)->toDateTimeString(),

'created_by'=>'Shyam',
'updated_by'=>'Shyam',
'deleted_at'=>'NULL',
'deleted_by'=>'NULL',

]




          	]);
	}

}