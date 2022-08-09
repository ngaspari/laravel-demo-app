<?php
namespace App\Domain\Services\Contacts;

use App\Repositiories\DoctrineContactRepository;

class EditContactService
{
    private $repo;
    
    public function __construct(
        DoctrineContactRepository $repo
    ) {
        $this->repo = $repo;
    }
    
    public function execute(
        $id,
        $firstName, 
        $lastName, 
        $address, 
        $city, 
        $country, 
        $email, 
        $phoneNumber
    ) {
        
        $contact = $this->repo->findById( $id );
        
        if ($contact == null) {
            throw new \Exception( sprintf('User with ID %1$s does not exist!', $id) );
        }
        
        $contact->update($firstName, $lastName, $address, $city, $country, $email, $phoneNumber);
        $this->repo->flush();
        
        return $contact;
    }
}