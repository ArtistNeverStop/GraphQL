<?php

namespace App\GraphQL\Type;

use Illuminate\Support\Fluent;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\ObjectType;
use App\Contracts\Support\ObjectTypeable;
use App\Traits\Support\ObjectTypefer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;

class FluentType extends Fluent implements ObjectTypeable
{
    use ObjectTypefer;

    /**
     * Create a new fluent container instance.
     *
     * @param  array|object    $attributes
     * @return void
     */
    public function __construct()
    {
        parent::__construct(array_diff_key(
        	array_merge(
                ['fields' => function () {
                    return $this->fields();
                }]
                ,
                ['resolveField' => function ($parent, $args, $context, ResolveInfo $info) {
                    dd($parent, $info->fieldName);
                    $uppercase = isset($args['uppercase']) ? $args['uppercase'] : null;
                    if ($parent instanceof Model) {
                        if ($uppercase) {
                            return strtoupper($parent->{$info->fieldName});
                        }
                        return $parent->{$info->fieldName};
                    }
                    if ($parent instanceof Builder || $parent instanceof QueryBuilder) {
                        $parent->select(array_merge($parent->getQuery()->columns ?: [], [$info->fieldName]));
                        return new \GraphQL\Deferred(function () use ($parent, $info) {
                            return $parent->first()->{$info->fieldName};
                        });
                    }
                }]
                ,
                get_object_vars($this)
            ),
        	['attributes' => null]
    	));
    }
}
