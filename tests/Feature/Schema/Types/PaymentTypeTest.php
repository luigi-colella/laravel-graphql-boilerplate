<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Payment;
use Tests\TestCase;

class PaymentTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_payment_type()
    {
        $model = factory(Payment::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    payment (id: {$model->getKey()}) {
                        customerNumber
                        checkNumber
                        paymentDate
                        amount
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.payment', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_payment_type()
    {
        $model = factory(Payment::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    payments {
                        edges {
                            node {
                                customerNumber
                                checkNumber
                                paymentDate
                                amount
                            }
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.payments.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_customer_relationship_of_payment_type()
    {
        $model = factory(Payment::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    payment (id: {$model->getKey()}) {
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
            ->assertJsonPath('data.payment.customer', $model->customer->toArray());
    }
}
