<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Country;
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
            
            // then populate
            Contact::factory(100)->create();
            Country::factory(100)->create();
        });
        
    }
}
