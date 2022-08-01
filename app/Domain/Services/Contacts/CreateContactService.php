<?php
namespace App\Domain\Services\Contacts;

use App\Repositiories\DoctrineContactRepository;
use App\Entities\Contact;

class CreateContactService
{
    private $repo;
    
    public function __construct(
        DoctrineContactRepository $repo
    ) {
        $this->repo = $repo;
    }
    
    public function execute(
        $firstName, 
        $lastName, 
        $address, 
        $city, 
        $country, 
        $email, 
        $phoneNumber
    ) {
        $contact = new Contact($firstName, $lastName, $address, $city, $country, $email, $phoneNumber);
        
        $this->repo->add($contact);
        
        return $contact;
    }
}