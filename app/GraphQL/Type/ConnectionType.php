<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Fluent;
use App\GraphQL\Types;

class ConnectionType extends FluentType
{
    /**
     * The name of The type
     *
     * @var string
     */
    public $name = 'Connection';

    /**
     * The name of The type
     *
     * @var string
     */
    public function fields()
    {
        return [
            'edges' => [
                'type' => Type::nonNull(Type::listOf(Types::edge())),
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    return $parent->get();
                }
            ],
            'totalCount' => [
                'type' => Type::int(),
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    return $this->getQueryBuilder($parent)->getCountForPagination();
                }
            ],
            'pageInfo' => [
                'type' => Types::pageInfo(),
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    return $parent->getModel()->count();
                }
            ]
        ];
    }

    public function getQueryBuilder($queryBuilderWraper)
    {
        if (method_exists($queryBuilderWraper, 'getQuery')) {
            return $this->getQueryBuilder($queryBuilderWraper->getQuery());
        } else {
            return $queryBuilderWraper;
        }
    }
}
