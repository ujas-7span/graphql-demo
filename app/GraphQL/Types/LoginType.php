<?php 

namespace App\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class LoginType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'login',
        'description'   => 'A user login',
    ];

    public function fields(): array
    {
        return  [
            'user' => [
                'type' => GraphQL::type('user'),
                'description' => 'Logged In User'
            ],
            'token' =>  [
                'type' => Type::string(),
                'description' => 'The token of user'
            ]
        ];
    }
}