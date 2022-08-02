<?php
namespace App\DbSeeder;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entities\Contact;
use Faker\Generator as FakerGen;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\RelationType;

class ContactsDataLoader implements FixtureInterface
{
    
    private $faker;
    private $nrOfContacts;
    
    /** @var ArrayCollection */
    private $createdContacts;
    
    public function __construct( FakerGen $faker, $nrOfContacts = 10 ) {
        $this->faker = $faker;
        $this->nrOfContacts = $nrOfContacts;
        
        $this->createdContacts = new ArrayCollection();
    }
    
    public function load(ObjectManager $manager)
    {
        
        $faker = $this->faker;
        
        for ($i=0; $i < $this->nrOfContacts; $i++) {
            $contact = new Contact(
                $faker->firstName(),
                $faker->lastName(),
                $faker->address(),
                $faker->city(),
                $faker->country,
                $faker->email(),
                $faker->phoneNumber()
            );
            
            // generate random relation
            if (rand(1, 9999) % 7) {
                $this->genRandomRelation( $contact );
            }
            
            $this->createdContacts->add( $contact );
            
            $manager->persist($contact);
            $manager->flush();
        }
        
    }

    
    private function genRandomRelation(Contact &$contact) {
        if (!$this->createdContacts->isEmpty()) {
            $key = array_rand( $this->createdContacts->getKeys() );
            
            $relative = $this->createdContacts->get( $key );
            
            if ($relative != null) {
                $contact->addRelative($relative, RelationType::getRandom());
                
                return true;
            }
        }
        
        return false;
        
    }
    
}