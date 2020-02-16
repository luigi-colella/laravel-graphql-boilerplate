<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Payment;
use Tests\TestCase;

class PaymentTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_payment_type_correctly()
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
}
