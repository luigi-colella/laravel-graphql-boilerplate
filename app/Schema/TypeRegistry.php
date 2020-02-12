<?php
namespace App\Schema;

use App\Schema\Types\CustomerType;
use App\Schema\Types\PaginationOfType;
use GraphQL\Type\Definition\Type;

/**
 * Registry of custom GraphQL types
 */
class TypeRegistry extends Type
{
    /**
     * @var CustomerType
     */
    private static $customer;

    public static function customer(): CustomerType
    {
        return self::$customer ?: (self::$customer = new CustomerType());
    }

    public static function paginationOf(Type $type): PaginationOfType
    {
        return new PaginationOfType($type);
    }
}