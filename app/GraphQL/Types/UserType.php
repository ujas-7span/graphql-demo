<?php 

namespace App\GraphQL\Types;

use App\Models\Country;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'user',
        'description'   => 'User',
        'model'         => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of the uer',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Uuer',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'The email of Uuer',
            ],
            'mobileNumber' => [
                'type' => Type::string(),
                'description' => 'The mobile number of the User',
                'alias' => 'mobile_number',
            ],
        ];
    }
}