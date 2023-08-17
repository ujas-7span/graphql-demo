<?php

namespace App\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\InputType;

class LoginInput extends InputType
{
    protected $attributes = [
        'name'          => 'LoginInput',
        'description'   => 'Login Input',
    ];

    public function fields(): array
    {
        return [
            'email' => [
                'type' => Type::string(),
                'rules' => [ 'required', 'max:255' , 'exists:users,email']
            ],
            'password' => [
                'type' => Type::string(),
                'rules' => [ 'required', 'max:255' ]
            ]
        ];
    }
}