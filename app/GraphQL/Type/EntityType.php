<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\UnionType;
use App\GraphQL\Types;
use App\User;
use App\Product;

class EntityType extends UnionType
{

    /**
     * UnionType constructor.
     *
     * @param $config
     */
    public function __construct($config = null)
    {
        parent::__construct(
            [
            'name' => 'Entity',
            'types' => [
                Types::product(),
                Types::user()
            ],
            'resolveType' => function ($parent) {
                if ($parent->getModel() instanceof User) {
                    return Types::user();
                } else {
                    return Types::product();
                }
            },
            ]
        );
    }
}
