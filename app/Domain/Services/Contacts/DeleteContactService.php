<?php
namespace App\Domain\Services\Contacts;

use App\Repositiories\DoctrineContactRepository;

class DeleteContactService
{
    private $repo;
    
    public function __construct(
        DoctrineContactRepository $repo
    ) {
        $this->repo = $repo;
    }
    
    public function execute(
        $id
    ) {
        $contact = $this->repo->findById( $id );
        
        if ($contact == null) {
            throw new \Exception( sprintf('User with ID %1$s does not exist!', $id) );
        }
        
        $this->repo->remove($contact);;
        
        return true;
    }
}