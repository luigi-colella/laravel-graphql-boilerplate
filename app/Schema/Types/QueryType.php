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
                    'resolve' => function ($root, $args) {
                        $customers = Customer::all();
                        $lastCustomerId = $customers->last()->customerNumber;
                        $endCustomerId = Customer::select('customerNumber')->orderBy('customerNumber', 'DESC')->first()->customerNumber;

                        return [
                            PaginationOfType::FIELD_TOTAL_COUNT => Customer::count(),
                            PaginationOfType::FIELD_EDGES => $customers,
                            PaginationOfType::FIELD_END_CURSOR => $lastCustomerId,
                            PaginationOfType::FIELD_HAS_NEXT_PAGE => $lastCustomerId !== $endCustomerId,
                        ];
                    }
                ],
            ],
        ]);
    }
}