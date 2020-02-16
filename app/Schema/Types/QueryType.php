<?php

namespace App\Schema\Types;

use App\Models\Customer;
use App\Models\Employee;
use App\Models\Office;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductLine;
use App\Schema\FieldRegistry;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;

class QueryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Query',
            'fields' => [
                'customer' => FieldRegistry::model(TypeRegistry::customer(), Customer::class),
                'customers' => FieldRegistry::models(TypeRegistry::customer(), Customer::class),
                'employee' => FieldRegistry::model(TypeRegistry::employee(), Employee::class),
                'employees' => FieldRegistry::models(TypeRegistry::employee(), Employee::class),
                'office' => FieldRegistry::model(TypeRegistry::office(), Office::class),
                'offices' => FieldRegistry::models(TypeRegistry::office(), Office::class),
                'order' => FieldRegistry::model(TypeRegistry::order(), Order::class),
                'orders' => FieldRegistry::models(TypeRegistry::order(), Order::class),
                'orderDetail' => FieldRegistry::model(TypeRegistry::orderDetail(), OrderDetail::class),
                'orderDetails' => FieldRegistry::models(TypeRegistry::orderDetail(), OrderDetail::class),
                'payment' => FieldRegistry::model(TypeRegistry::payment(), Payment::class),
                'payments' => FieldRegistry::models(TypeRegistry::payment(), Payment::class),
                'product' => FieldRegistry::model(TypeRegistry::product(), Product::class),
                'products' => FieldRegistry::models(TypeRegistry::product(), Product::class),
                'productLine' => FieldRegistry::model(TypeRegistry::productLine(), ProductLine::class),
                'productLines' => FieldRegistry::models(TypeRegistry::productLine(), ProductLine::class),
            ],
        ]);
    }
}