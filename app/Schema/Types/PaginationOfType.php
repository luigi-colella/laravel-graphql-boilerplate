<?php

namespace App\Schema\Types;

use App\Schema\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type as DefinitionType;
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

    public function __construct(DefinitionType $edgeType)
    {
        parent::__construct([
            'fields' => [
                [
                    'name' => self::FIELD_TOTAL_COUNT,
                    'type' => Type::int(),
                    'resolve' => function (array $value) {
                        return $value[self::FIELD_TOTAL_COUNT];
                    }
                ],
                [
                    'name' => self::FIELD_EDGES,
                    'type' => Type::listOf(new ObjectType([
                        'name' => 'edge',
                        'fields' => [
                            'node' => $edgeType,
                            'cursor' => Type::id(),
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
                            self::FIELD_END_CURSOR => Type::id(),
                            self::FIELD_HAS_NEXT_PAGE => Type::boolean(),
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
