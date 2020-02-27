<?php

namespace Tests\Unit\Schema;

use App\Models\Order;
use App\Schema\ModelLoader;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ModelLoaderTest extends TestCase
{
    /**
     * @test
     */
    public function load_relation_on_models_eagerly()
    {
        $relation = 'customer';

        $model1 = factory(Order::class)->create()->unsetRelation($relation);
        $model2 = factory(Order::class)->create()->unsetRelation($relation);
        $model3 = factory(Order::class)->create()->unsetRelation($relation);
        $model4 = factory(Order::class)->create()->unsetRelation($relation);
        $model5 = factory(Order::class)->create()->unsetRelation($relation);
        
        DB::enableQueryLog();

        $this->assertFalse($model1->relationLoaded($relation));
        $this->assertFalse($model2->relationLoaded($relation));
        $this->assertFalse($model3->relationLoaded($relation));
        $this->assertFalse($model4->relationLoaded($relation));
        $this->assertFalse($model5->relationLoaded($relation));

        ModelLoader::add($model1);
        ModelLoader::add($model2);
        ModelLoader::add($model3);
        ModelLoader::add($model4);
        ModelLoader::add($model5);

        $this->assertEquals($model1->customerNumber, ModelLoader::load($model1, $relation)->getKey());
        $this->assertEquals($model2->customerNumber, ModelLoader::load($model2, $relation)->getKey());
        $this->assertEquals($model3->customerNumber, ModelLoader::load($model3, $relation)->getKey());
        $this->assertEquals($model4->customerNumber, ModelLoader::load($model4, $relation)->getKey());
        $this->assertEquals($model5->customerNumber, ModelLoader::load($model5, $relation)->getKey());

        $this->assertCount(1, DB::getQueryLog());
    }
}
