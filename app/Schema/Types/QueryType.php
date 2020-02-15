<?php

namespace App\Schema\Types;

use App\Models\Customer;
use App\Schema\FieldRegistry;
use App\Schema\ModelPaginator;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => TypeRegistry::string(),
                    'args' => [
                        'message' => [
                            'type' => TypeRegistry::nonNull(TypeRegistry::string()),
                            'description' => 'The message to display'
                        ],
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'customer' => FieldRegistry::model(TypeRegistry::customer(), Customer::class),
                'customers' => FieldRegistry::models(TypeRegistry::customer(), Customer::class),
            ],
        ]);
    }
}