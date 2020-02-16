<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Product;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_product_type_correctly()
    {
        $model = factory(Product::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    product (id: {$model->customerNumber}) {
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
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.product', $model->toArray());
    }
}
