<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class EmployeeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'description' => 'Employee info',
            'fields' => function () {
                return [
                    'employeeNumber' => TypeRegistry::id(),
                    'lastName' => TypeRegistry::string(),
                    'firstName' => TypeRegistry::string(),
                    'extension' => TypeRegistry::string(),
                    'email' => TypeRegistry::string(),
                    'officeCode' => TypeRegistry::string(),
                    'reportsTo' => TypeRegistry::int(),
                    'jobTitle' => TypeRegistry::string(),
                    'customers' => TypeRegistry::listOf(TypeRegistry::customer()),
                ];
            }
        ]);
    }
}