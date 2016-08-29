<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteBoardTypesSeederTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		
		\DB::table('quote_board_types')->insert([
          	[

'type'=>'Laminated Board',
'remarks'=>'',

],

         	[


'type'=>'Customised Board',
'remarks'=>'',

],
[


'type'=>'Aluminium Composite Panel(ACP)',
'remarks'=>'',

],	 
[


'type'=>'Aluminium Particle Board(APB)',
'remarks'=>'',

],
[


'type'=>'New Board',
'remarks'=>'',

] 
           ]);
		// $this->call("OthersTableSeeder");
	}

}