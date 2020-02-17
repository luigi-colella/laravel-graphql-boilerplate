<?php

namespace Tests\Feature\Schema\Types;

use App\Models\OrderDetail;
use App\Models\Product;
use Tests\TestCase;

class ProductTypeTest extends TestCase
{
    /**
     * @test
     */
    public function graphql_endpoint_returns_product_type()
    {
        $model = factory(Product::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    product (id: {$model->getKey()}) {
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

    /**
     * @test
     */
    public function graphql_endpoint_returns_list_of_product_type()
    {
        $model = factory(Product::class)->create();

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    products {
                        edges {
                            node {
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
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.products.edges.0.node', $model->toArray());
    }

    /**
     * @test
     */
    public function graphql_endpoint_returns_order_detail_relationship_of_product_type()
    {
        $relatedModel = factory(OrderDetail::class)->create();
        $model = $relatedModel->product;

        $this->post(self::GRAPHQL_ENDPOINT, [
            'query' => "
                {
                    product (id: {$model->getKey()}) {
                        orderDetail {
                            orderNumber
                            productCode
                            quantityOrdered
                            priceEach
                            orderLineNumber
                        }
                    }
                }
            ",
        ])
            ->assertSuccessful()
            ->assertJsonPath('data.product.orderDetail', $relatedModel->unsetRelation('product')->toArray());
    }
}
