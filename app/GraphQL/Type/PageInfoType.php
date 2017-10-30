<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types;

class PageInfoType extends FluentType
{
	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public $name = 'PageInfo';

	/**
	 * The name of The type
	 *
	 * @var string
	 */
	public function fields() {
		return [
        	'endCursor' => [
				'type' => Type::string()
        	],
        	'nextPage' => [
				'type' => Type::string()
        	]
		];
	}
}
