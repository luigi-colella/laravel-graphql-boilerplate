<?php

namespace App\Schema\Types;

use App\Schema\FieldRegistry;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class OfficeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'description' => 'Office info',
            'fields' => function () {
                return [
                    'officeCode' => TypeRegistry::id(),
                    'city' => TypeRegistry::string(),
                    'phone' => TypeRegistry::string(),
                    'addressLine1' => TypeRegistry::string(),
                    'addressLine2' => TypeRegistry::string(),
                    'state' => TypeRegistry::string(),
                    'country' => TypeRegistry::int(),
                    'postalCode' => TypeRegistry::string(),
                    'territory' => TypeRegistry::string(),
                    'employees' => FieldRegistry::relation(TypeRegistry::listOf(TypeRegistry::employee())),
                ];
            },
        ]);
    }
}