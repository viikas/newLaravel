<?php

namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;

class quotetemplateseeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
       \DB::table('quote_templates')->truncate();
        \DB::table('quote_templates')->insert([
            [
                'code' => 'W1',
                'description' => '2 LEAVES SLIDING WINDOW WITH FLY SCREEN',
                'image' => NUll,
                'type' => 'single',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2014, 3, 17)->toDateTimeString(),
                 'created_by'=>'Ram',
                 'updated_by'=>'Ram',
                 'deleted_by'=> 'NULL',  
                 'deleted_at'=>'NULL',
            ],
            [
                'code' => 'W3',
                'description' => '3 LEAVES SLIDING WINDOW 4/4 WITH FLY SCREEN ',
                'image' => NUll,
                'type' => 'single',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2014, 3, 17)->toDateTimeString(),
                 'created_by'=>'Ram',
                 'updated_by'=>'Ram',
                 'deleted_by'=> 'NULL',  
                 'deleted_at'=>'NULL',
            ],
            [
                'code' => 'W4',
                'description' => '1 LEAF CASEMENT OPENABLE BELOW FIXED LIGHT ',
                'image' => NUll,
                'type' => 'matrix',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2014, 3, 17)->toDateTimeString(),
                 'created_by'=>'Ram',
                 'updated_by'=>'Ram',
                 'deleted_by'=> 'NULL',  
                 'deleted_at'=>'NULL',
            ]
        ]);
    }

}
