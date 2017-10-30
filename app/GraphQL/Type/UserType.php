<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Database\Eloquent\Model;
use App\GraphQL\Types;

class UserType extends FluentType
{
	/**
	 * The name of The type.
	 *
	 * @var string
	 */
	public $name = 'User';

	/**
	 * The fields for this GraphQL Type.
	 *
	 * @var string
	 */
	public function fields() {
		return [
			'id' => Type::int(),
			'name' => [
				'type' => Type::string(),
				'args' => [
					'uppercase' => Type::boolean()
				]
        	],
			'email' => [
				'type' => Type::string()
			],
			'products' => [
				'type' => Type::listOf(Types::product())
			]
		];
	}
}
