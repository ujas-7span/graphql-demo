<?php

namespace App\GraphQL\Mutations\Auth;

use Closure;
use GraphQL;
use App\Services\AuthService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;

class LoginMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Login Mutation',
    ];

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    
    public function type(): Type
    {
        return GraphQL::Type('login');
    }

    public function args(): array
    {
        return [
            'input' => [
                'alias' => 'input',
                'type' => GraphQL::type('loginInput'),
                'rules' => ['required'],
            ]
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return $this->authService->login($args['input']);
    }
}