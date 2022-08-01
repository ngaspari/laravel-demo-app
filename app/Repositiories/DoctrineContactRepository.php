<?php
namespace App\Repositiories;

use Doctrine\ORM\EntityRepository;
use App\Entities\Contact;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineContactRepository extends EntityRepository
{ 

    /** @var EntityManagerInterface */
    private $em;
    
    
    /**
     * 
     * @param int $id
     * @return Contact|null
     */
    public function findById( $id )
    {
        return $this->findOneBy(['id' => $id]);
    }
    
    
    /**
     *
     * @return Contact[]|null
     */
    public function all()
    {
        return $this->findAll();
    }
    
    
    public function remove(Contact $contact)
    {
        $this->getEntityManager()->remove($contact);
        $this->getEntityManager()->flush();
        return true;
    }
    
    public function add(Contact $contact)
    {
        $this->getEntityManager()->persist( $contact );
        $this->getEntityManager()->flush();
        return true;
    }
    
    public function flush() {
        $this->getEntityManager()->flush();
        return true;
    }
    
}