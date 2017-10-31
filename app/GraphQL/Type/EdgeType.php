<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types;

class EdgeType extends FluentType
{
    /**
     * The name of The type
     *
     * @var string
     */
    public $name = 'Edge';

    /**
     * The name of The type
     *
     * @var string
     */
    public function fields()
    {
        return [
            'node' => [
                'type' => Types::entity(),
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    return $parent;
                    // return [
                    //     'name' => $parent->name
                    // ];
                }
            ],
            'cursor' => [
                'type' => Type::string(),
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    return $parent->id;
                }
            ]
        ];
    }
}
