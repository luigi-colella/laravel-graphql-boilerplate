<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_order_type()
    {
        $model = factory(Order::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    orders {
                        edges {
                            node {
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
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.orders.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_order_details_relationship_of_order_type()
    {
        $model = factory(Order::class)->create();
        $relatedModel1 = factory(OrderDetail::class)->create();
        $relatedModel1->orderNumber = $model->getKey();
        $relatedModel1->save();
        $relatedModel2 = factory(OrderDetail::class)->create(['orderNumber' => $model->getKey()]);
        $relatedModel2->orderNumber = $model->getKey();
        $relatedModel2->save();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    order (id: {$model->getKey()}) {
                        orderDetails {
                            orderNumber
                            productCode
                            quantityOrdered
                            priceEach
                            orderLineNumber
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.order.orderDetails', [$relatedModel1->toArray(), $relatedModel2->toArray()]);
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_customer_relationship_of_order_type()
    {
        $model = factory(Order::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    order (id: {$model->getKey()}) {
                        customer {
                            customerNumber
                            customerName
                            contactLastName
                            contactFirstName
                            phone
                            addressLine1
                            addressLine2
                            city
                            state
                            postalCode
                            country
                            salesRepEmployeeNumber
                            creditLimit
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.order.customer', $model->customer->toArray());
    }
}
