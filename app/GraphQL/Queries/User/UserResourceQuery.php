<?php

namespace App\GraphQL\Queries\User;

use Closure;
use App\Services\UserService;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Facades\GraphQL;

class UserResourceQuery extends Query
{
    protected $attributes = [
        'name' => 'User detail query',
    ];

    public function __construct(private UserService $userService)
    {
    }

    public function type(): Type
    {
        return GraphQL::type('user');
    }

    public function args(): array
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::int()],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $id = $args['id'] ?? auth()->id();
        return $this->userService->resource($id);
    }
}
