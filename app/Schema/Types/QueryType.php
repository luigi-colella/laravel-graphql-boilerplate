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
            'fields' => function () {
                return [
                    'customer' => FieldRegistry::rootModel(TypeRegistry::customer(), Customer::class),
                    'customers' => FieldRegistry::rootList(TypeRegistry::customer(), Customer::class),
                    'employee' => FieldRegistry::rootModel(TypeRegistry::employee(), Employee::class),
                    'employees' => FieldRegistry::rootList(TypeRegistry::employee(), Employee::class),
                    'office' => FieldRegistry::rootModel(TypeRegistry::office(), Office::class),
                    'offices' => FieldRegistry::rootList(TypeRegistry::office(), Office::class),
                    'order' => FieldRegistry::rootModel(TypeRegistry::order(), Order::class),
                    'orders' => FieldRegistry::rootList(TypeRegistry::order(), Order::class),
                    'orderDetail' => FieldRegistry::rootModel(TypeRegistry::orderDetail(), OrderDetail::class),
                    'orderDetails' => FieldRegistry::rootList(TypeRegistry::orderDetail(), OrderDetail::class),
                    'payment' => FieldRegistry::rootModel(TypeRegistry::payment(), Payment::class),
                    'payments' => FieldRegistry::rootList(TypeRegistry::payment(), Payment::class),
                    'product' => FieldRegistry::rootModel(TypeRegistry::product(), Product::class),
                    'products' => FieldRegistry::rootList(TypeRegistry::product(), Product::class),
                    'productLine' => FieldRegistry::rootModel(TypeRegistry::productLine(), ProductLine::class),
                    'productLines' => FieldRegistry::rootList(TypeRegistry::productLine(), ProductLine::class),
                ];
            }
        ]);
    }
}