<?php
namespace App\Domain;

interface PaginatedDataTransformerInterface
{
    public function write(Paginator $paginator);
    
    public function read();
}
