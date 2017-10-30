<?php

namespace App\Traits\Support;

use GraphQL\Type\Definition\ObjectType;

trait ObjectTypefer
{
    /**
     * Get the ObjectType instance.
     *
     * @return GraphQL\Type\Definition\ObjectType
     */
    public function toObjectType() : ObjectType
    {
    	return new ObjectType($this->toArray());
    }
}
