<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Model;

class PaginationOfType extends ObjectType
{
    /**
     * The fields of which this type is composed
     */
    public const FIELD_TOTAL_COUNT = 'totalCount';
    public const FIELD_EDGES = 'edges';
    public const FIELD_END_CURSOR = 'endCursor';
    public const FIELD_HAS_NEXT_PAGE = 'hasNextPage';

    public function __construct(Type $type)
    {
        parent::__construct([
            'fields' => [
                [
                    'name' => self::FIELD_TOTAL_COUNT,
                    'type' => TypeRegistry::int(),
                    'resolve' => function (array $value) {
                        return $value[self::FIELD_TOTAL_COUNT];
                    }
                ],
                [
                    'name' => self::FIELD_EDGES,
                    'type' => TypeRegistry::listOf(new ObjectType([
                        'name' => 'edge',
                        'fields' => [
                            [
                                'name' => 'node',
                                'type'=> $type,
                                'resolve' => function ($edge) {
                                    return $edge;
                                },
                            ],
                            [
                                'name' => 'cursor',
                                'type' => TypeRegistry::id(),
                                'resolve' => function (Model $edge) {
                                    return $edge->getKey();
                                }
                            ]
                        ],
                    ])),
                    'resolve' => function (array $value) {
                        return $value[self::FIELD_EDGES];
                    }
                ],
                [
                    'name' => 'pageInfo',
                    'type' => new ObjectType([
                        'name' => 'pageInfo',
                        'fields' => [
                            self::FIELD_END_CURSOR => TypeRegistry::id(),
                            self::FIELD_HAS_NEXT_PAGE => TypeRegistry::boolean(),
                        ]
                    ]),
                    'resolve' => function (array $value) {
                        return (object) [
                            self::FIELD_END_CURSOR => $value[self::FIELD_END_CURSOR],
                            self::FIELD_HAS_NEXT_PAGE => $value[self::FIELD_HAS_NEXT_PAGE],
                        ];
                    }
                ],
            ],
        ]);
    }
}
