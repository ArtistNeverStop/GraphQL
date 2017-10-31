<?php

namespace App\GraphQL;

use App\GraphQL\Type\UserType;
use App\GraphQL\Type\ProductType;
use App\GraphQL\Type\PaginableType;
use App\GraphQL\Type\EntityType;
use App\GraphQL\Type\NodeType;
use App\GraphQL\Type\EdgeType;
use App\GraphQL\Type\ConnectionType;
use App\GraphQL\Type\PageInfoType;

/**
 * Class Types
 *
 * Acts as a registry and factory for your types.
 *
 * As simplistic as possible for the sake of clarity of this example.
 * Your own may be more dynamic (or even code-generated).
 *
 * @package GraphQL\Examples\Blog
 */
class Types
{
    /**
     * Object types:
     */
    private static $user;
    private static $product;
    private static $paginable;
    private static $node;
    private static $connection;
    private static $entity;
    private static $edge;
    private static $pageInfo;
    // private static $image;
    // private static $query;

    /**
     * @return UserType
     */
    public static function user()
    {
        return self::$user ?: (self::$user = (new UserType())->toObjectType());
    }

    /**
     * @return ProductType
     */
    public static function product()
    {
        return self::$product ?: (self::$product = (new ProductType())->toObjectType());
    }

    /**
     * @return PaginableType
     */
    public static function paginable()
    {
        return self::$paginable ?: (self::$paginable = new PaginableType());
    }

    /**
     * @return PaginableType
     */
    public static function entity()
    {
        return self::$entity ?: (self::$entity = new EntityType());
    }

    /**
     * @return PaginableType
    public static function node()
    {
        return self::$node ?: (self::$node = (new NodeType())->toObjectType();
    }
     */

    /**
     * @return EdgeType
     */
    public static function edge()
    {
        return self::$edge ?: (self::$edge = (new EdgeType())->toObjectType());
    }

    /**
     * @return ConnectionType
     */
    public static function connection()
    {
        return self::$connection ?: (self::$connection = (new ConnectionType())->toObjectType());
    }

    /**
     * @return PageInfoType
     */
    public static function pageInfo()
    {
        return self::$pageInfo ?: (self::$pageInfo = (new PageInfoType())->toObjectType());
    }

    /**
     * @return PaginableType
     */
    public static function makeNestedBuilder(&$builder, $queryNested, $info = null)
    {
        $relations = $with = $fields = [];
        foreach ($queryNested as $key => $item) {
            if (in_array($key, $builder->getModel()->queryable)) {
                $fields[] = $key;
            } else if (is_array($item) && in_array($key, $builder->getModel()->queryableRelations)) {
                $relations[] = $key;
            }
        }
        $fields = array_merge($fields, $builder->getModel()->alwaysSelect);
        $builder->select($fields);
        foreach ($relations as $relation) {
            // $limit = null;
            // if (substr($relation, -10) === 'Connection') {
            //     $relation = explode('Connection', $relation)[0];
            // }
            $with[$relation] = function (&$query) use ($queryNested, $relation) {
                static::makeNestedBuilder($query, $queryNested[$relation]);
            };
        }
        $builder->with($with);
        return $builder;
    }
}
