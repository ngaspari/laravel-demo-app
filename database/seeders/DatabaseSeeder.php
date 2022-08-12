<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Country;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        DB::transaction(function(){            
            // delete first
            Contact::query()->delete();
            Country::query()->delete();
            
            $savedCountries = [];

            // then populate
            Country::factory(100)->create()->each(function($country) use (&$savedCountries) {
                $savedCountries[] = $country;
            });
            
            Contact::factory(100)->create()->each(function($countact) use ($savedCountries) {
                $key = array_rand($savedCountries, 1);
                $savedCountries[$key]->contacts()->save( $countact );
            });
        });
        
    }
}
