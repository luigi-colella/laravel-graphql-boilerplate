<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Office;
use Tests\TestCase;

class officeTypeTest extends TestCase
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_office_type()
    {
        $model = factory(Office::class)->create();

        $json = $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    offices {
                        edges {
                            node {
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
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.offices.edges.0.node', $model->toArray());
    }
}
