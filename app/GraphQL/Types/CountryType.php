<?php 

namespace App\GraphQL\Types;

use App\Models\Country;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class CountryType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'country',
        'description'   => 'Country',
        'model'         => Country::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the country',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Country',
            ],
            'countryCode' => [
                'type' => Type::string(),
                'description' => 'The code of the country',
                'alias' => 'country_code',
            ],
        ];
    }
}