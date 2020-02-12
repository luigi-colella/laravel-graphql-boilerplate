<?php

namespace App\Schema\Types;

use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

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
                            'node' => $type,
                            'cursor' => TypeRegistry::id(),
                        ],
                    ])),
                    'resolve' => function (array $value) {

                        $edges = $value[self::FIELD_EDGES];
                        if (! $edges instanceof Collection) {
                            throw new RuntimeException('The passed edges are not an instance of Eloquent Collection.');
                        }

                        return $edges->map(function (Model $edge) {
                            return (object) [
                                'node' => $edge,
                                'cursor' => $edge->getKey(),
                            ];
                        });
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
