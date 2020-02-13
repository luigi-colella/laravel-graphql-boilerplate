<?php

namespace App\Schema\Types;

use App\Models\Customer;
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
                        'message' => TypeRegistry::nonNull(TypeRegistry::string()),
                    ],
                    'resolve' => function ($root, $args) {
                        return $root['prefix'] . $args['message'];
                    }
                ],
                'customer' => [
                    'type' => TypeRegistry::customer(),
                    'args' => [
                        'id' => TypeRegistry::int(),
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
                        ],
                        'first' => [
                            'type' => TypeRegistry::int(),
                            'defaultValue' => 10,
                        ],
                    ],
                    'resolve' => function ($root, $args) {
                        $customers = Customer::where('customerNumber', '>', $args['after'])->take($args['first'])->get();
                        $endCustomerId = Customer::select('customerNumber')->orderBy('customerNumber', 'DESC')->first()->customerNumber;
                        $hasNextPage = $customers->isNotEmpty() && ! $customers->contains('customerNumber', $endCustomerId);

                        return [
                            PaginationOfType::FIELD_TOTAL_COUNT => Customer::count(),
                            PaginationOfType::FIELD_EDGES => $customers,
                            PaginationOfType::FIELD_END_CURSOR => $endCustomerId,
                            PaginationOfType::FIELD_HAS_NEXT_PAGE => $hasNextPage,
                        ];
                    }
                ],
            ],
        ]);
    }
}