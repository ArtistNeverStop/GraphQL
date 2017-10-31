<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Model;
use App\GraphQL\Types;

class UserType extends FluentType
{
    /**
     * The name of The type.
     *
     * @var string
     */
    public $name = 'User';

    /**
     * The fields for this GraphQL Type.
     *
     * @var string
     */
    public function fields()
    {
        return [
            'id' => Type::int(),
            'name' => [
                'type' => Type::string(),
                'args' => [
                    'uppercase' => Type::boolean()
                ]
            ],
            'email' => [
                'type' => Type::string()
            ],
            'products' => [
                'type' => Type::listOf(Types::product()),
                'args' => [
                    'first' => [
                        'type' => Type::nonNull(Type::int())
                    ],
                    'after' => [
                        'type' => Type::string()
                    ]
                ]
            ],
            'productsConnection' => [
                'type' => Types::connection(),
                'args' => [
                    'first' => [
                        'type' => Type::nonNull(Type::int())
                    ],
                    'after' => [
                        'type' => Type::string()
                    ]
                ],
                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                    $query = $parent->products()->limit($args['first']);
                    if (isset($args['after'])) {
                        $query->skip($args['after']);
                    }
                    return $query;
                    // return Product::limit($args['first'])->skip(isset($args['after']) ? $args['after'] : null);
                    // return [
                    //     'edges' => User::take($args['first'])->get(),
                    //     'totalCount' => User::count()
                    // ];
                }
            ]
        ];
    }
}
