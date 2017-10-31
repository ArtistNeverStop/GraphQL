<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
// use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\UnionType;
use App\GraphQL\Types;
use App\User;

class PaginableType extends UnionType
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
            'name' => 'Paginable',
            'types' => [
                Types::product(),
                Types::user()
            ],
            'resolveType' => function ($builder) {
                if ($builder->getModel() instanceof User) {
                    return Types::user();
                } else {
                    return Types::product();
                }
            },
            ]
        );
    }
}