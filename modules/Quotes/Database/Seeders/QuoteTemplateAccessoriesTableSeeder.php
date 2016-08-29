<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteTemplateAccessoriesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('quote_template_accessories')->insert([
            [
                'quote_template_id_fk' => '1',
                'accessory_id_fk' => '1',
                'formula' => '2H',
                'is_roller'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'accessory_id_fk' => '2',
                'formula' => '2H',
                'is_roller'=>1
            ],            
        ]);
	}

}