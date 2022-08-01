<?php
namespace App\Repositiories;

use App\Domain\PaginatableQueryInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineContactsQuery implements PaginatableQueryInterface
{
    
    private $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    
    public function getPrefix()
    {
        return 'c';
    }

    public function getQueryBuilder()
    {
        $qb = $this->em->createQueryBuilder();
        
        $qb->select('c')
            ->from('App\Entities\Contact', 'c');
            
        return $qb;
    }
    
}