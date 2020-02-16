<?php

namespace Tests\Feature\Schema\Types;

use App\Models\OrderDetail;
use Tests\TestCase;

class OrderDetailTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_order_detail_type()
    {
        $model = factory(OrderDetail::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    orderDetail (id: {$model->getKey()}) {
                        orderNumber
                        productCode
                        quantityOrdered
                        priceEach
                        orderLineNumber
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.orderDetail', $model->toArray());
    }
}
