<?php

namespace Modules\Quotes\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class QuotesDatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        // $this->call("Modules\Quotes\Database\Seeders\quotetemplateseeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteTemplateSettingTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteTemplateProfilesTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteTemplateAccessoriesTableSeeder");

        // $this->call("Modules\Quotes\Database\Seeders\QuoteStatusTableSeeder");
        // $this// $this->call("Modules\Quotes\Database\Seeders\QuoteGlobalSettingsSeeder");->call("Modules\Quotes\Database\Seeders\QuoteGlobalSettingsSeeder");
      //   $this->call("Modules\Quotes\Database\Seeders\QuotesQuoteTableSeeder");
        //$this->call("Modules\Quotes\Database\Seeders\QuoteItemsTableSeeder");

        // $this->call("Modules\Quotes\Database\Seeders\QuoteItemTemplateTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteItemTemplateSettingTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteItemTemplateProfilesTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteItemTemplateAccessoriesTableSeeder");
       // $this->call("Modules\Quotes\Database\Seeders\QuoteCmsSeederTableSeeder");
       // $this->call("Modules\Quotes\Database\Seeders\QuoteActivityLogSeederTableSeeder");
        //$this->call("Modules\Quotes\Database\Seeders\QuoteGlassTypesSeederTableSeeder");
      // $this->call("Modules\Quotes\Database\Seeders\QuoteGlassTypeThicknessSeederTableSeeder");
         //$this->call("Modules\Quotes\Database\Seeders\QuoteBoardTypesSeederTableSeeder");
        // $this->call("Modules\Quotes\Database\Seeders\QuoteBoardTypesThicknessSeederTableSeeder");
     //$this->call("Modules\Quotes\Database\Seeders\QuoteProfileSeederTableSeeder");
     $this->call("Modules\Quotes\Database\Seeders\AdditionalDatainCMSTableSeeder");
    }

}
