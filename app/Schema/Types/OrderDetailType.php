<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class OrderDetailType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'description' => 'Order detail info',
            'fields' => function () {
                return [
                    'orderNumber' => TypeRegistry::id(),
                    'productCode' => TypeRegistry::string(),
                    'quantityOrdered' => TypeRegistry::int(),
                    'priceEach' => TypeRegistry::float(),
                    'orderLineNumber' => TypeRegistry::int(),
                    'order' => TypeRegistry::order(),
                    'product' => TypeRegistry::product(),
                ];
            },
        ]);
    }
}