<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Order;
use Tests\TestCase;

class OrderTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_order_type()
    {
        $model = factory(Order::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    order (id: {$model->getKey()}) {
                        orderNumber
                        orderDate
                        requiredDate
                        shippedDate
                        status
                        comments
                        customerNumber
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.order', $model->toArray());
    }
}
