<?php

namespace App\Http\Controllers;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Utils\BuildSchema;
use Illuminate\Http\Request;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;
use App\GraphQL\Type\UserType;
use App\GraphQL\Types;
use App\User;
use App\Product;

class GraphQLController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function root(Request $request)
    // {
    //     return GraphQL::execute(
    //         BuildSchema::build(config('graphql.schema')),
    //         $request->input('query'),
    //         [
    //             'sum' => function($root, $args, $context, ResolveInfo $resolveInfo) {
    //                 return $args['x'] + $args['y'];
    //             },
    //             'echo' => function($root, $args, $context, ResolveInfo $resolveInfo) {
    //                 return $root['prefix'] . $args['message'];
    //             },
    //             'user' => function($root, $args, $context, ResolveInfo $resolveInfo) {
    //                 return [
    //                     'id' => 1,
    //                     'name' => 'Diego Meza',
    //                     'email' => 'diego.dgmr.dm@gmail.com'
    //                 ];
    //             },
    //             'paginable' => function($root, $args, $context, ResolveInfo $resolveInfo) {
    //                 return [
    //                     'id' => 1,
    //                     'name' => 'Diego Meza',
    //                     'email' => 'diego.dgmr.dm@gmail.com'
    //                 ];
    //             },
    //             'prefix' => 'You said: ',
    //         ],
    //         null,
    //         $request->input('variables')
    //     );
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function root(Request $request)
    {
        return GraphQL::executeQuery(
            new Schema(
                [
                'query' => new ObjectType(
                    [
                        'name' => 'Query',
                        'fields' => [

                            /**
                             * User Query
                             */
                            'user' => [
                                'type' => Types::user(),
                                'args' => [
                                    'id' => Type::nonNull(Type::int())
                                ],
                                'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                                    $query = User::where($args);
                                    $query = Types::makeNestedBuilder($query, $info->getFieldSelection(100), $info->fieldNodes[0]);
                                    return new \GraphQL\Deferred(
                                        function () use ($query) {
                                            return $query->first();
                                        }
                                    );
                                }
                            ],

                            // /**
                            //  * Users Query
                            //  */
                            // 'users' => [
                            //     'type' => Type::nonNull(Type::listOf(Types::user())),
                            //     'args' => [
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         $query = User::query();
                            //         $query = Types::makeNestedBuilder($query, $info->getFieldSelection(100));
                            //         return new \GraphQL\Deferred(
                            //             function () use ($query) {
                            //                 return $query->get();
                            //             }
                            //         );
                            //     }
                            // ],

                            // /**
                            //  * Users Query
                            //  */
                            // 'usersConnection' => [
                            //     'type' => Type::nonNull(Types::connection()),
                            //     'args' => [
                            //         'first' => [
                            //             'type' => Type::nonNull(Type::int())
                            //         ],
                            //         'after' => [
                            //             'type' => Type::string()
                            //         ]
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         return User::limit($args['first'])->skip(isset($args['after']) ? $args['after'] : null);
                            //         // return [
                            //         //     'edges' => User::take($args['first'])->get(),
                            //         //     'totalCount' => User::count()
                            //         // ];
                            //     }
                            // ],

                            // /**
                            //  * Users Query
                            //  */
                            // 'productsConnection' => [
                            //     'type' => Type::nonNull(Types::connection()),
                            //     'args' => [
                            //         'first' => [
                            //             'type' => Type::nonNull(Type::int())
                            //         ],
                            //         'after' => [
                            //             'type' => Type::string()
                            //         ]
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         \GraphQL\Error\FormattedError::setInternalErrorMessage("Unexpected error");
                            //         return Product::limit($args['first'])->skip(isset($args['after']) ? $args['after'] : null);
                            //         // return [
                            //         //     'edges' => User::take($args['first'])->get(),
                            //         //     'totalCount' => User::count()
                            //         // ];
                            //     }
                            // ],

                            // /**
                            //  * Products Query
                            //  */
                            // 'products' => [
                            //     'type' => Type::nonNull(Type::listOf(Types::product())),
                            //     'args' => [
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         $query = Product::query();
                            //         $query = Types::makeNestedBuilder($query, $info->getFieldSelection(100));
                            //         return new \GraphQL\Deferred(
                            //             function () use ($query) {
                            //                 return $query->get();
                            //             }
                            //         );
                            //     }
                            // ],

                            // /**
                            //  * ProductsConnection Query
                            // 'products' => [
                            //     'type' => Type::nonNull(Type::listOf(Types::product())),
                            //     'args' => [
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         $query = Product::query();
                            //         $query = Types::makeNestedBuilder($query, $info->getFieldSelection(100));
                            //         return new \GraphQL\Deferred(function () use ($query) {
                            //             return $query->get();
                            //         });
                            //     }
                            // ],
                            //  */

                            // /**
                            //  * Search Query
                            //  */
                            // 'paginables' => [
                            //     'type' => Type::listOf(Types::paginable()),
                            //     'args' => [
                            //         'name' => Type::nonNull(Type::string())
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         $query = User::where('name', 'LIKE', $args['name'])->get()->concat(Product::where('name', 'LIKE', $args['name'])->get());
                            //         return $query;
                            //         return new \GraphQL\Deferred(
                            //             function () use ($query) {
                            //                 return $query->get();
                            //             }
                            //         );
                            //     }
                            // ],

                            // /**
                            //  * Paginable Query
                            //  */
                            // 'paginable' => [
                            //     'type' => Types::paginable(),
                            //     'args' => [
                            //         'id' => Type::nonNull(Type::int())
                            //     ],
                            //     'resolve' => function ($parent, $args, $context, ResolveInfo $info) {
                            //         return $query = User::where($args);
                            //         // return new \GraphQL\Deferred(function () use ($query) {
                            //         //     return $query->first();
                            //         // });
                            //     }
                            // ],
                        ],
                    ]
                ),
                'mutation' => null,
                ]
            ),
            $request->input('query'),
            [
                'prefix' => 'You Nigga said: ',
            ],
            null,
            $request->input('variables')
        )->toArray(true);
    }
}
