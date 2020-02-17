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

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_order_detail_type()
    {
        $model = factory(OrderDetail::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    orderDetails {
                        edges {
                            node {
                                orderNumber
                                productCode
                                quantityOrdered
                                priceEach
                                orderLineNumber
                            }
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.orderDetails.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_order_relationship_of_order_detail_type()
    {
        $model = factory(OrderDetail::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    orderDetail (id: {$model->getKey()}) {
                        order {
                            orderNumber
                            orderDate
                            requiredDate
                            shippedDate
                            status
                            comments
                            customerNumber
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.orderDetail.order', $model->order->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_product_relationship_of_order_detail_type()
    {
        $model = factory(OrderDetail::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    orderDetail (id: {$model->getKey()}) {
                        product {
                            productCode
                            productName
                            productLine
                            productScale
                            productVendor
                            productDescription
                            quantityInStock
                            buyPrice
                            MSRP
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.orderDetail.product', $model->product->toArray());
    }
}
