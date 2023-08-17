<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Illuminate\Pagination\LengthAwarePaginator;
use Rebing\GraphQL\Support\Type as GraphQLType;

class Pagination extends GraphQLType
{
    protected $attributes = [
        'name' => 'pagination',
        'description' => 'Pagination Detail',
    ];

    public function fields(): array
    {
        return [
            'from' => [
                'type' => Type::int(),
                'description' => 'The first id of current result set',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->firstItem(),
            ],
            'to' => [
                'type' => Type::int(),
                'description' => 'The last id of current result set',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->lastItem(),
            ],
            'perPage' => [
                'alias' => 'per_page',
                'type' => Type::int(),
                'description' => 'Total number of object which returns per page',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->perPage(),
            ],
            'currentPage' => [
                'alias' => 'current_page',
                'type' => Type::int(),
                'description' => 'The current page of provided result',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->currentPage(),
            ],
            'lastPage' => [
                'alias' => 'last_page',
                'type' => Type::int(),
                'description' => 'The last page of provided result',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->lastPage(),
            ],
            'total' => [
                'type' => Type::int(),
                'description' => 'Total number of object',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->total(),
            ],
            'resultCount' => [
                'alias' => 'result_count',
                'type' => Type::int(),
                'description' => 'Total number of object for returned result',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->count(),
            ],
            'hasMorePages' => [
                'alias' => 'has_more_pages',
                'type' => Type::boolean(),
                'description' => 'Return the flag for checking whether the more pages are available or not',
                'resolve' => fn (LengthAwarePaginator $root, $args) => $root->hasMorePages(),
            ],
            'after' => [
                'type' => Type::float(), // Here we need to took type as float hence int don't support for long int,
                'description' => 'The next id of the current object to get next page in cursor pagination.',
                'resolve' => function (LengthAwarePaginator $root, $args) {
                    $options = $root->getOptions();

                    return ! empty($options['after']) ? $options['after'] : null;
                },
            ],
        ];
    }
}
