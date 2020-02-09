<?php

namespace App\Schema;

use App\Schema\Types\QueryType;
use GraphQL\Type\Schema as TypeSchema;

class Schema extends TypeSchema
{
    public function __construct()
    {
        parent::__construct([
            'query' => new QueryType(),
        ]);
    }
}