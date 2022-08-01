<?php
namespace app\Domain;

interface PaginatableQueryInterface
{
    public function getPrefix();
    
    public function getQueryBuilder();
}