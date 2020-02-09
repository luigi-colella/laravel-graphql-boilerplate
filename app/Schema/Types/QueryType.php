<?php

namespace App\Schema\Types;

use App\Models\Customer;
use App\Schema\Type;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'customer' => [
                    'type' => Type::customer(),
                    'args' => [
                        'id' => Type::int(),
                    ],
                    'resolve' => function ($root, $args) {
                        return Customer::find($args['id']);
                    }
                ],
                'customers' => [
                    'type' => Type::listOf(Type::customer()),
                    'resolve' => function ($root, $args) {
                        return Customer::all();
                    }
                ],
            ],
        ]);
    }
}