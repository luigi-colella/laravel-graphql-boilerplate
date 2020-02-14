<?php

namespace App\Schema\Types;

use App\Schema\ModelPaginator;
use App\Schema\TypeRegistry;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Model;

class PaginationOfType extends ObjectType
{
    public function __construct(Type $type)
    {
        parent::__construct([
            'fields' => [
                [
                    'name' => 'totalCount',
                    'type' => TypeRegistry::int(),
                    'resolve' => function (ModelPaginator $paginator) {
                        return $paginator->getTotalCount();
                    }
                ],
                [
                    'name' => 'edges',
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
                    'resolve' => function (ModelPaginator $paginator) {
                        return $paginator->getItems();
                    }
                ],
                [
                    'name' => 'pageInfo',
                    'type' => new ObjectType([
                        'name' => 'pageInfo',
                        'fields' => [
                            'endCursor' => TypeRegistry::id(),
                            'hasNextPage' => TypeRegistry::boolean(),
                        ]
                    ]),
                    'resolve' => function (ModelPaginator $paginator) {
                        return (object) [
                            'endCursor' => $paginator->getEndCursor(),
                            'hasNextPage' => $paginator->hasNextPage(),
                        ];
                    }
                ],
            ],
        ]);
    }
}
