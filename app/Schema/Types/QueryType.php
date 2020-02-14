<?php

namespace App\Schema\Types;

use App\Models\Customer;
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
                'customer' => [
                    'type' => TypeRegistry::customer(),
                    'args' => [
                        'id' => [
                            'type' => TypeRegistry::nonNull(TypeRegistry::int()),
                            'description' => 'The ID of customer to fetch',
                        ],
                    ],
                    'resolve' => function ($root, $args) {
                        return Customer::find($args['id']);
                    }
                ],
                'customers' => [
                    'type' => TypeRegistry::paginationOf(TypeRegistry::customer()),
                    'args' => [
                        'after' => [
                            'type' => TypeRegistry::id(),
                            'defaultValue' => 1,
                            'description' => 'The offset after which records will be taken',
                        ],
                        'first' => [
                            'type' => TypeRegistry::int(),
                            'defaultValue' => 10,
                            'description' => 'The limit of returned records',
                        ],
                    ],
                    'resolve' => function ($root, $args) {
                        return new ModelPaginator(Customer::class, $args['after'], $args['first']);
                    }
                ],
            ],
        ]);
    }
}