<?php namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
use Modules\Blog\Entities\Blog;
class BlogTableSeeder extends Seeder {

	/**
	 * Run the table seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = Factory::create();  
        foreach(range(1,12) as $index)
        {
            Blog::create([                
                'title' => $faker->paragraph($nbSentences = 1),
                'details' =>$faker->numberBetween($nbSentences = 1)
            ]);
        }
	}
}
