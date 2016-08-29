<?php namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuoteItemTemplateAccessoriesTableSeeder extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    \DB::table('quote_item_template_accessories')->insert([
            [
                'quote_item_template_id_fk' => '1',
                
                'acc_ref' => '1000',
                'description' => 'test',
                'formula' => '2l*h',
                'qty_length' => '12.00',
                'mu_cost_rs' => '10.00',
                'total_price' => '120.00',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '1',
                
                'acc_ref' => '1001',
                'description' => 'test',
                'formula' => '2l*2h',
                'qty_length' => '15.00',
                'mu_cost_rs' => '15.00',
                'total_price' => '225.00',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '2',
                
                'acc_ref' => '1002',
                'description' => 'test',
                'formula' => 'l*2h',
                'qty_length' => '25.00',
                'mu_cost_rs' => '10.00',
                'total_price' => '250.00',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '2',
                
                'acc_ref' => '1003',
                'description' => 'test',
                'formula' => 'l*h',
                'qty_length' => '10.00',
                'mu_cost_rs' => '10.00',
                'total_price' => '100.00',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
            [
                'quote_item_template_id_fk' => '3',
                
                'acc_ref' => '1004',
                'description' => 'test',
                'formula' => '2l*3h',
                'qty_length' => '15.00',
                'mu_cost_rs' => '15.00',
                'total_price' => '225.00',
                'created_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::createFromDate(2016, 3, 17)->toDateTimeString(),
                 
            ],
           ]);
    // $this->call("OthersTableSeeder");
  }

}