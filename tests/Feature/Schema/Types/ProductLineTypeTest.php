<?php

namespace Tests\Feature\Schema\Types;

use App\Models\ProductLine;
use Tests\TestCase;

class ProductLineTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_product_line_type()
    {
        $model = factory(ProductLine::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    productLine (id: {$model->getKey()}) {
                        productLine
                        textDescription
                        htmlDescription
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.productLine', $model->toArray());
    }
}
