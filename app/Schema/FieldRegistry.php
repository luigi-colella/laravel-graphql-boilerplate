<?php
namespace App\Schema;

use GraphQL\Type\Definition\Type;

/**
 * Registry of custom GraphQL fields
 */
class FieldRegistry
{
    /**
     * Return the schema field for a single model at the root of schema
     * 
     * @param Type $type
     * @param string $modelClass
     * 
     * @return array
     */
    public static function rootModel(Type $type, string $modelClass): array
    {
        return [
            'type' => $type,
            'args' => [
                'id' => [
                    'type' => TypeRegistry::nonNull(TypeRegistry::id()),
                    'description' => 'The ID of model to fetch',
                ],
            ],
            'resolve' => function ($root, $args) use ($modelClass) {
                return $modelClass::find($args['id']);
            }
        ];
    }

    /**
     * Return the schema field for a list of models at the root of schema
     * 
     * @param Type $type
     * @param string $modelClass
     * 
     * @return array
     */
    public static function rootList(Type $type, string $modelClass): array
    {
        return [
            'type' => TypeRegistry::paginationOf($type),
            'args' => [
                'after' => [
                    'type' => TypeRegistry::id(),
                    'defaultValue' => 0,
                    'description' => 'The offset after which records will be taken',
                ],
                'first' => [
                    'type' => TypeRegistry::int(),
                    'defaultValue' => 10,
                    'description' => 'The limit of returned records',
                ],
            ],
            'resolve' => function ($root, $args) use ($modelClass) {
                return new ModelPaginator($modelClass, $args['after'], $args['first']);
            }
        ];
    }
}