<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Definition GraphQL Schema
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'schema' => '
        schema {
            query: Query,
            mutation: Calc
        }

        type Query {
            echo(message: String): String,
            user: User,
            paginable: Paginable
        }

        type Calc {
            sum(x: Int, y: Int): Int
        }

        type User {
            id: Int,
            name: String,
            email: String
        }

        type Product {
            sku: Int,
            name: String
        }

        union Paginable = User | Product
    '
];