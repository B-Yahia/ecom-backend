<?php

declare(strict_types=1);

namespace InputTypes;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class OrderlineInputType extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'product' => Type::nonNull(InputTypeContainer::product()),
                'units' => Type::nonNull(Type::int()),
                'selectedAttributes' => Type::listOf(InputTypeContainer::selectedAttribute())
            ],
        ];
        parent::__construct($config);
    }
}
