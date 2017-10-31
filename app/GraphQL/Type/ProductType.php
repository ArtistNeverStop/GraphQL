<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types;

class ProductType extends FluentType
{
    /**
     * The name of The type
     *
     * @var string
     */
    public $name = 'Product';

    /**
     * The name of The type
     *
     * @var string
     */
    public function fields()
    {
        return [
            'id' => Type::int(),
            'name' => [
                'type' => Type::string()
            ],
            'price' => [
                'type' => Type::int()
            ],
            'user' => [
                'type' => Types::user()
            ],
            'user_id' => [
                'type' => Type::int()
            ]
        ];
    }
}
