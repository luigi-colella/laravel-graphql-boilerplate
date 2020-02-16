<?php
namespace App\Schema;

use App\Schema\Types\CustomerType;
use App\Schema\Types\EmployeeType;
use App\Schema\Types\OfficeType;
use App\Schema\Types\OrderDetailType;
use App\Schema\Types\OrderType;
use App\Schema\Types\PaginationOfType;
use App\Schema\Types\PaymentType;
use App\Schema\Types\ProductLineType;
use App\Schema\Types\ProductType;
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

    /** @var OrderType */
    private static $order;

    /** @var OrderDetailType */
    private static $orderDetail;

    /** @var PaymentType */
    private static $payment;

    /** @var ProductType */
    private static $product;

    /** @var ProductLineType */
    private static $productLine;

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

    public static function order(): OrderType
    {
        return self::$order ?: (self::$order = new OrderType());
    }

    public static function orderDetail(): OrderDetailType
    {
        return self::$orderDetail ?: (self::$orderDetail = new OrderDetailType());
    }

    public static function payment(): PaymentType
    {
        return self::$payment ?: (self::$payment = new PaymentType());
    }

    public static function product(): ProductType
    {
        return self::$product ?: (self::$product = new ProductType());
    }

    public static function productLine(): ProductLineType
    {
        return self::$productLine ?: (self::$productLine = new ProductLineType());
    }
}