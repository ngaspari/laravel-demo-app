<?php
namespace app\Domain\Services\Contacts;

use App\Domain\PaginatedDataTransformerInterface;
use App\Domain\Paginator;

class ContactsPaginatedDto implements  PaginatedDataTransformerInterface
{
    
    private $paginator;
    
    public function read()
    {
        return [
            'page' 		=> $this->paginator->getPageNumber(),
            'total' 	=> $this->paginator->getTotalPages(),
            'records'	=> $this->paginator->getTotalItems(),
            'rows' 		=> $this->getRows()
        ];
    }

    public function write(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }
    
    private function getRows()
    {
        $rows = [];
        foreach ($this->paginator->getPaginatedResult() as $contact)
        {
            $rows[] = $contact->toArray();
        }
        return $rows;
    }

}

