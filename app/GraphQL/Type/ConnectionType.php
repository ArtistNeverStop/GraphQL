<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types;

class ConnectionType extends FluentType
{
	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public $name = 'Connection';

	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public function fields() {
		return [
			'edges' => Type::listOf(Types::edge()),
			'totalCount' => [
				'type' => Type::int()
        	],
    //     	'of' => [
				// 'type' => Type::string()
    //     	],
        	'pageInfo' => [
				'type' => Types::pageInfo()
        	]
		];
	}
}
