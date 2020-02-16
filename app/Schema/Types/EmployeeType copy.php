<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class CustomerType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'customer',
            'description' => 'Customer info',
            'fields' => [
                'customerNumber' => TypeRegistry::id(),
                'customerName' => TypeRegistry::string(),
                'contactLastName' => TypeRegistry::string(),
                'contactFirstName' => TypeRegistry::string(),
                'phone' => TypeRegistry::string(),
                'addressLine1' => TypeRegistry::string(),
                'addressLine2' => TypeRegistry::string(),
                'city' => TypeRegistry::string(),
                'state' => TypeRegistry::string(),	
                'postalCode' => TypeRegistry::string(),
                'country' => TypeRegistry::string(),
                'salesRepEmployeeNumber' => TypeRegistry::int(),
                'creditLimit' => TypeRegistry::float(),
            ]
        ]);
    }
}