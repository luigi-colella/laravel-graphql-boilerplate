<?php
namespace App\Schema;

use App\Schema\Types\CustomerType;
use App\Schema\Types\EmployeeType;
use App\Schema\Types\OfficeType;
use App\Schema\Types\OrderDetailType;
use App\Schema\Types\PaginationOfType;
use GraphQL\Type\Definition\Type;

/**
 * Registry of custom GraphQL types
 */
class TypeRegistry extends Type
{
    /** @var array */
    private static $paginationOf = [];

    /** @var CustomerType */
    private static $customer;

    /** @var EmployeeType */
    private static $employee;

    /** @var OfficeType */
    private static $office;

    /** @var OrderDetailType */
    private static $orderDetail;

    public static function paginationOf(Type $type): PaginationOfType
    {
        $typeName = $type->toString();
        return isset(self::$paginationOf[$typeName]) ? self::$paginationOf[$typeName] : (self::$paginationOf[$typeName] = new PaginationOfType($type));
    }

    public static function customer(): CustomerType
    {
        return self::$customer ?: (self::$customer = new CustomerType());
    }

    public static function employee(): EmployeeType
    {
        return self::$employee ?: (self::$employee = new EmployeeType());
    }

    public static function office(): OfficeType
    {
        return self::$office ?: (self::$office = new OfficeType());
    }

    public static function orderDetail(): OrderDetailType
    {
        return self::$orderDetail ?: (self::$orderDetail = new OrderDetailType());
    }
}