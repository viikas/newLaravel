<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteTemplateProfilesTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
	\DB::table('quote_template_profiles')->insert([
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '12',
                'formula' => '1L',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '46',
                'formula' => '1L',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '47',
                'formula' => '2H',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '48',
                'formula' => '1L',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '49',
                'formula' => '',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '52',
                'formula' => '',
                'is_fly_screen'=>1
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '50',
                'formula' => '2H',
                'is_fly_screen'=>0
            ],
            [
                'quote_template_id_fk' => '1',
                'profile_id_fk' => '51',
                'formula' => '2H',
                'is_fly_screen'=>0
            ],
        ]);
	}
}