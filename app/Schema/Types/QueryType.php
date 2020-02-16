<?php

namespace App\Schema\Types;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Schema\FieldRegistry;
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
                'employee' => FieldRegistry::model(TypeRegistry::employee(), Employee::class),
                'employees' => FieldRegistry::models(TypeRegistry::employee(), Employee::class),
                'office' => FieldRegistry::model(TypeRegistry::office(), Office::class),
                'offices' => FieldRegistry::models(TypeRegistry::office(), Office::class),
                'order' => FieldRegistry::model(TypeRegistry::order(), Order::class),
                'orders' => FieldRegistry::models(TypeRegistry::order(), Order::class),
                'orderDetail' => FieldRegistry::model(TypeRegistry::orderDetail(), OrderDetail::class),
                'orderDetails' => FieldRegistry::models(TypeRegistry::orderDetail(), OrderDetail::class),
            ],
        ]);
    }
}