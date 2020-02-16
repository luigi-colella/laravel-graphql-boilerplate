<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Office;
use Tests\TestCase;

class OfficeTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_office_type()
    {
        $model = factory(Office::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    office (id: {$model->getKey()}) {
                        officeCode
                        city
                        phone
                        addressLine1
                        addressLine2
                        state
                        country
                        postalCode
                        territory
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.office', $model->toArray());
    }
}
