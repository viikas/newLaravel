<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdditionalDatainCMSTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
			\DB::table('quote_cms')->insert([


                    [
          	
          	'cms_code'=>'Remarks',
               'description'=>'remark description',
               'remarks'=>'remarks for quotes',
          	'field_value'=>'remarks',
               'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',

          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

          	],
          	[
          	
          	'cms_code'=>'rem_pay-1',
          	'field_value'=>'1',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
               'description'=>'remaining payment1',
               'remarks'=>'remaining payment1',
               'category'=>'quote',
               'field_type'=>'tinyint',
               'length'=>'0',
          	],
          	[
          	
          	'cms_code'=>'rem_pay-2',
          	'field_value'=>'1',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
               'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'remaining payment2',
               'remarks'=>'remaining payment2',
                 'category'=>'quote',
               'field_type'=>'tinyint',
               'length'=>'0',
          	],

          	[
          	
          	'cms_code'=>'rem_pay-3',
          	'field_value'=>'1',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'remaining payment3',
               'remarks'=>'remaining payment3',
                 'category'=>'quote',
               'field_type'=>'tinyint',
               'length'=>'0',
          	],
          	[
          	
          	'cms_code'=>'rem_pay-4',
          	'field_value'=>'1',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'remaining payment4',
               'remarks'=>'remaining payment 4',
                 'category'=>'quote',
               'field_type'=>'tinyint',
               'length'=>'0',
          	],
          	[
          	
          	'cms_code'=>'rem_pay-5',
          	'field_value'=>'1',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'remaining payment 5',
               'remarks'=>'remaining payment 5',
                 'category'=>'quote',
               'field_type'=>'tinyint',
               'length'=>'0',
          	],
          	[
          	
          	'cms_code'=>'VAT_pc',
          	'field_value'=>'13%',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'VAT percentage',
               'remarks'=>'vatpercentage',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	[
          	
          	'cms_code'=>'guarantee_years',
          	'field_value'=>'2 years',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'guarantee years',
               'remarks'=>'guarantee years',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	[
          	
          	'cms_code'=>'quote_contact',
          	'field_value'=>'this is contact',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'contact',
               'remarks'=>'contact',
               'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	[
          	
          	'cms_code'=>'quote_title',
          	'field_value'=>'this is title',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'contact',
               'remarks'=>'contact',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          		[
          	
          	'cms_code'=>'quote_department',
          	'field_value'=>'this is quote department',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'quote department',
               'remarks'=>'remarks for quote department',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          		[
          	
          	'cms_code'=>'Project_type',
          	'field_value'=>'Residence',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'project type',
               'remarks'=>'project type',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],

          		[
          	
          	'cms_code'=>'Prices_include',
          	'field_value'=>'Prices_include',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'price includes',
               'remarks'=>'price includes',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	          		[
          	
          	'cms_code'=>'Payment_mode',
          	'field_value'=>'Payment',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'payment mode',
               'remarks'=>'payment mode',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	[
          	
          	'cms_code'=>'Validity',
          	'field_value'=>'2yrs',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'Validity',
               'remarks'=>'Validity',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],
          	[
          	
          	'cms_code'=>'Notes',
          	'field_value'=>'Notes here',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
                 'description'=>'notes',
               'remarks'=>'notes',
                 'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	],

          	[
          	
          	'cms_code'=>'Terms & conditions',
          	'field_value'=>'terms',
          	'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
			'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
               'description'=>'Terms & conditions',
               'remarks'=>'Terms & conditions',
               'category'=>'quote',
               'field_type'=>'text',
               'length'=>'200',
          	]




          	]);
          	


	}

}