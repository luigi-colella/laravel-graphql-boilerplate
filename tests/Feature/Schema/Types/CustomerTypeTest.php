<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Customer;
use Tests\TestCase;

class CustomerTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_customer_type_correctly()
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
}
