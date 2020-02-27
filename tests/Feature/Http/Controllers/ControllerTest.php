<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_an_error_if_no_id_is_specified_for_a_single_model()
    {
        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => '
                {
                    customer {
                        customerName
                    }
                }
            ',
        ])
            ->assertSuccessful()
            ->assertJsonPath('errors.0.message', 'Field "customer" argument "id" of type "ID!" is required but not provided.');
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_a_single_model()
    {
        $model = factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customer (id: {$model->customerNumber}) {
                        customerName
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customer.customerName', $model->customerName);
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_a_list_of_models_with_pagination_info()
    {
        factory(Customer::class)->create();
        $model2 = factory(Customer::class)->create();
        $model3 = factory(Customer::class)->create();
        $model4 = factory(Customer::class)->create();
        $model5 = factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customers (after: {$model2->customerNumber}, first: 2) {
                        totalCount
                        edges {
                            cursor
                            node {
                                customerName
                            }
                        }
                        pageInfo {
                            endCursor
                            hasNextPage
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customers', [
                'totalCount' => 5,
                'edges' => [
                    [
                        'cursor' => $model3->customerNumber,
                        'node' => [
                            'customerName' => $model3->customerName,
                        ],
                    ],
                    [
                        'cursor' => $model4->customerNumber,
                        'node' => [
                            'customerName' => $model4->customerName,
                        ]
                    ],
                ],
                'pageInfo' => [
                    'endCursor' => $model5->customerNumber,
                    'hasNextPage' => true,
                ],
            ]);
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_a_list_of_models_with_has_next_page_field_equal_to_false()
    {
        factory(Customer::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customers {
                        edges {
                            cursor
                        }
                        pageInfo {
                            hasNextPage
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customers.pageInfo.hasNextPage', false);
    }

    /**
     * @test
     */
    public function graphql_endpoint_batches_database_queries()
    {
        $city1 = factory(Customer::class)->create()->salesRepEmployee->office->city;
        $city2 = factory(Customer::class)->create()->salesRepEmployee->office->city;
        $city3 = factory(Customer::class)->create()->salesRepEmployee->office->city;

        DB::enableQueryLog();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    customers {
                        edges {
                            node {
                                salesRepEmployee {
                                    office {
                                        city
                                    }
                                }
                            }
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.customers.edges.0.node.salesRepEmployee.office.city', $city1)
            ->assertJsonPath('data.customers.edges.1.node.salesRepEmployee.office.city', $city2)
            ->assertJsonPath('data.customers.edges.2.node.salesRepEmployee.office.city', $city3);

        $this->assertCount(3, DB::getQueryLog());
    }
}
