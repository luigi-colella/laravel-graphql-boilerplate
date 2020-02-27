<?php

namespace App\Schema;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ModelLoader
{
    /**
     * The class of model used to fetch items
     * 
     * @var array
     */
    private static $models = [];

    /**
     * Add a model for which load relations
     * 
     * @param Model $model
     */
    public static function add(Model $model)
    {
        self::$models[$model->getTable()][] = $model;
    }

    /**
     * Load relation on the added models and return that one belonging to provided model.
     * 
     * @param Model $model
     * @param string $relation
     * 
     * @return Model
     */
    public static function load(Model $model, string $relation): Model
    {
        $collection = new Collection(self::$models[$model->getTable()]);
        $collection->loadMissing($relation);

        return $model->{$relation};
    }
}