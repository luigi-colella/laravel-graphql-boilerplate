<?php

namespace Tests\Feature\Schema\Types;

use App\Models\Product;
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
                    productLine (id: \"{$model->getKey()}\") {
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_product_line_type()
    {
        $model = factory(ProductLine::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    productLines {
                        edges {
                            node {
                                productLine
                                textDescription
                                htmlDescription
                            }
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.productLines.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_products_relationship_of_product_line_type()
    {
        $model = factory(ProductLine::class)->create();
        $relatedModel1 = factory(Product::class)->create(['productLine' => $model->getKey()]);
        $relatedModel2 = factory(Product::class)->create(['productLine' => $model->getKey()]);

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    productLine (id: \"{$model->getKey()}\") {
                        products {
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
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.productLine.products', [$relatedModel1->toArray(), $relatedModel2->toArray()]);
        }
}
