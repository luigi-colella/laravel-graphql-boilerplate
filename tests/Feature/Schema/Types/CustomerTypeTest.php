<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Customer;
use App\Models\Order;
use Tests\TestCase;

class CustomerTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_customer_type()
    {
        $model = factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customer (id: {$model->getKey()}) {
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
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customer', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_customer_type()
    {
        $model = factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customers {
                        edges {
                            node {
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
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customers.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_salesRepEmployee_relationship_of_customer_type()
    {
        $model = factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customer (id: {$model->getKey()}) {
                        salesRepEmployee {
                            employeeNumber
                            lastName
                            firstName
                            extension
                            email
                            officeCode
                            reportsTo
                            jobTitle
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customer.salesRepEmployee', $model->salesRepEmployee->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_orders_relationship_of_customer_type()
    {
        $model = factory(Customer::class)->create();
        $relatedModel1 = factory(Order::class)->create();
        $relatedModel2 = factory(Order::class)->create();
        $model->orders()->saveMany([$relatedModel1, $relatedModel2]);

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customer (id: {$model->getKey()}) {
                        orders {
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
            ->assertJsonPath('data.customer.orders', [$relatedModel1->toArray(), $relatedModel2->toArray()]);
    }
}
