<?php

declare(strict_types=1);

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

require __DIR__ . "/../../vendor/autoload.php";

class OrderlineType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'id' => Type::id(),
                'product' => Type::nonNull(new ProductType()),
                'units' => Type::nonNull(Type::int()),
                'selectedAttributes' => Type::listOf(new SelectedAttributeType())
            ]
        ];
        parent::__construct($config);
    }
}
