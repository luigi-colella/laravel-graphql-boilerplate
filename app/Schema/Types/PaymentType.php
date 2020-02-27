<?php

namespace App\Schema\Types;

use App\Schema\FieldRegistry;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class PaymentType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'description' => 'Payment info',
            'fields' => function () {
                return [
                    'customerNumber' => TypeRegistry::id(),
                    'checkNumber' => TypeRegistry::string(),
                    'paymentDate' => TypeRegistry::string(),
                    'amount' => TypeRegistry::float(),
                    'customer' => FieldRegistry::relation(TypeRegistry::customer()),
                ];
            },
        ]);
    }
}