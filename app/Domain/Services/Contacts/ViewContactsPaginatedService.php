<?php
namespace App\Domain\Services\Contacts;

use App\Repositiories\DoctrineContactsQuery;
use App\Domain\AbstractPaginatedQueryRequest;
use App\Domain\Paginator;

class ViewContactsPaginatedService
{
    private $dto;
    private $query;
    
    public function __construct(
        ContactsPaginatedDto $dto,
        DoctrineContactsQuery $query
    ) {
        $this->dto = $dto;
        $this->query = $query;
    }
    
    public function execute( AbstractPaginatedQueryRequest $request ) {
        $this->dto->write(
            (new Paginator($request))->paginate( $this->query)
        );
        return $this->dto->read();
    }
}