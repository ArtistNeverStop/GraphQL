<?php

namespace App\Contracts\Support;

use GraphQL\Type\Definition\ObjectType;

interface ObjectTypeable
{
    /**
     * Get the ObjectType instance.
     *
     * @return GraphQL\Type\Definition\ObjectType
     */
    public function toObjectType() : ObjectType;
}
