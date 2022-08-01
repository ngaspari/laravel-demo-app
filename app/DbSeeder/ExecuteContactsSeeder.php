<?php
namespace App\DbSeeder;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Generator as FakerGen;

class ExecuteContactsSeeder
{
    private $entityManager;
    private $faker;
    
    public function __construct( EntityManagerInterface $entityManager, FakerGen $faker) {
        $this->entityManager = $entityManager;
        $this->faker = $faker;
    }
    
    public function execute( $nrOfContacts = 100, $truncateFirst = false) {
        $loader = new Loader();
        $loader->addFixture(new ContactsDataLoader( $this->faker, $nrOfContacts ));
        
        $executor = new ORMExecutor($this->entityManager, new ORMPurger());
        $executor->execute($loader->getFixtures(), !$truncateFirst);
    }
    
}