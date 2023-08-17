<?php

namespace App\GraphQL\Types;

use Illuminate\Support\Collection;
use GraphQL\Type\Definition\ObjectType;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Pagination\LengthAwarePaginator;
use GraphQL\Type\Definition\Type as GraphQLType;

class PaginationType extends ObjectType
{
    public function __construct(string $typeName, string $customName = null)
    {
        $name = $customName ?: $typeName . 'Pagination';

        $config = [
            'name' => $name,
            'fields' => $this->getPaginationFields($typeName),
        ];

        $underlyingType = GraphQL::type($typeName);
        if (isset($underlyingType->config['model'])) {
            $config['model'] = $underlyingType->config['model'];
        }

        parent::__construct($config);
    }

    protected function getPaginationFields(string $typeName): array
    {
        return [
            'data' => [
                'type' => GraphQLType::listOf(GraphQL::type($typeName)),
                'description' => 'List of items on the current page',
                'resolve' => function (LengthAwarePaginator $data): Collection {
                    return $data->getCollection();
                },
            ],
            'pagination' => [
                'type' => GraphQL::type('pagination'),
                'resolve' => function (LengthAwarePaginator $root) {
                    return $root;
                },
                'selectable' => false
            ],
        ];
    }
}
