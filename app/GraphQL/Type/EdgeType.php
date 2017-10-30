<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types;

class EdgeType extends FluentType
{
	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public $name = 'Edge';

	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public function fields() {
		return [
			'node' => Type::listOf(Types::entity()),
			'cursor' => [
				'type' => Type::string()
        	],
		];
	}

	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public function resolve() {
		dd('resolve');
	}
}
