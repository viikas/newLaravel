<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteCmsSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		//Model::unguard();
		
		// $this->call("OthersTableSeeder");
		\DB::table('quote_cms')->insert([
          	[

'cms_code'=>'logo',
'description'=>'Logo (image upto 1MB)',
'remarks'=>'Logo to show in header of quote page',
'field_value'=>'money',
'category'=>'quote',
'field_type'=>'image',
'length'=>'0',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],

        	[

'cms_code'=>'technal-logo',
'description'=>'Technal Logo (image upto 1MB)',
'remarks'=>'Logo for technal to show in quote',
'field_value'=>'',
'category'=>'quote',
'field_type'=>'image',
'length'=>'0',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],

	[

'cms_code'=>'maenum-logo',
'description'=>'Maenum Logo(image upto 1MB)',
'remarks'=>'Logo for maenum to show in quote page',
'field_value'=>'',
'category'=>'quote',
'field_type'=>'image',
'length'=>'0',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
],
[

'cms_code'=>'quote_address',
'description'=>'skylight Address',
'remarks'=>'Address to show in quote page',
'field_value'=>'Naxal(Oppposite POlice H.Q), Kathmandu',
'category'=>'quote',
'field_type'=>'text',
'length'=>'200',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],

[

'cms_code'=>'quote_telephone',
'description'=>'skylight telephone',
'remarks'=>'telephone to show in quote page',
'field_value'=>'4-415-209,4-423-851',
'category'=>'quote',
'field_type'=>'telephone',
'length'=>'40',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],

[

'cms_code'=>'quote_fax',
'description'=>'skylight fax',
'remarks'=>'Fax to show in quote page',
'field_value'=>'4-42-489',
'category'=>'quote',
'field_type'=>'fax',
'length'=>'40',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],

[

'cms_code'=>'quote_email',
'description'=>'skylight email',
'remarks'=>'email to show in quote page',
'field_value'=>'info@skylight.com.np',
'category'=>'quote',
'field_type'=>'email',
'length'=>'50',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],
[

'cms_code'=>'quote_project_information',
'description'=>'project Information',
'remarks'=>'Project information for quote page',
'field_value'=>'[As in printed paper]',
'category'=>'quote',
'field_type'=>'text',
'length'=>'max',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],
[

'cms_code'=>'quote_terms_conditions',
'description'=>'Terms and conditions',
'remarks'=>'Terms and conditios to show in quote page',
'field_value'=>'[As in printed paper]',
'category'=>'quote',
'field_type'=>'text',
'length'=>'max',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],
[

'cms_code'=>'quote_foot_note',
'description'=>'Foot note',
'remarks'=>'Foot note to show in quote page',
'field_value'=>'NOTE: The availability of aluminium in our stock, to perform the scope of work enlisted in this quotation, is not yet confirmed at this stage.',
'category'=>'quote',
'field_type'=>'text',
'length'=>'max',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

],
[

'cms_code'=>'quote_footer',
'description'=>'Footer text',
'remarks'=>'Text to show in footer of quote page',
'field_value'=>'Glazing the Roof of the World',
'category'=>'quote',
'field_type'=>'text',
'length'=>'max',
'created_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),
'updated_at'=>\Carbon\Carbon::createFromDate(2016,4,17)->toDateTimeString(),

]



          	]);
	}

}