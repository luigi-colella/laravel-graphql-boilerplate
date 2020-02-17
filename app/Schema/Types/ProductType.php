<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class ProductType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'description' => 'Product info',
            'fields' => function () {
                return [
                    'productCode' => TypeRegistry::id(),
                    'productName' => TypeRegistry::string(),
                    'productLine' => TypeRegistry::string(),
                    'productScale' => TypeRegistry::string(),
                    'productVendor' => TypeRegistry::string(),
                    'productDescription' => TypeRegistry::string(),
                    'quantityInStock' => TypeRegistry::int(),
                    'buyPrice' => TypeRegistry::float(),
                    'MSRP' => TypeRegistry::float(),
                    'orderDetail' => TypeRegistry::orderDetail(),
                ];
            },
        ]);
    }
}