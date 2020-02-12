<?php
namespace App\Schema;

use App\Schema\Types\CustomerType;
use App\Schema\Types\PaginationOfType;
use GraphQL\Type\Definition\Type as AbstractType;

/**
 * Registry of custom GraphQL types
 */
class Type extends AbstractType
{
    /** @var CustomerType */
    private static $customer;

    public static function customer(): CustomerType
    {
        return self::$customer ?: (self::$customer = new CustomerType());
    }

    public static function paginationOf(AbstractType $type): PaginationOfType
    {
        return new PaginationOfType($type);
    }
}