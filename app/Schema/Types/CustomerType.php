<?php

namespace App\Schema\Types;

use App\Schema\Type;
use GraphQL\Type\Definition\ObjectType;

class CustomerType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'customer',
            'description' => 'Customer info',
            'fields' => [
                'customerNumber' => Type::id(),
                'customerName' => Type::string(),
                'contactLastName' => Type::string(),
                'contactFirstName' => Type::string(),
                'phone' => Type::string(),
                'addressLine1' => Type::string(),
                'addressLine2' => Type::string(),
                'city' => Type::string(),
                'state' => Type::string(),	
                'postalCode' => Type::string(),
                'country' => Type::string(),
                'salesRepEmployeeNumber' => Type::int(),
                'creditLimit' => Type::float(),
            ]
        ]);
    }
}