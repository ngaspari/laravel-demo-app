<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\DbSeeder\ExecuteContactsSeeder;

class ContactsSeederCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DB seeder command for contacts';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ExecuteContactsSeeder $seeder)
    {
        
        $nrOfContacts = $this->ask('Number of contacts to seed ?', 100);
        
        $truncateFirst = $this->choice(
            'Truncate data first?',
            ['Y', 'N'],
            0
        );
        
        $seeder->execute( $nrOfContacts, $truncateFirst == 'Y' );
        
        $this->info(' >> Task completed << ');
        
        return 0;
    }
}
