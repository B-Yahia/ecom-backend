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
                'product' => Type::nonNull(TypeContainer::product()),
                'quatity' => Type::nonNull(Type::int()),
                'listOfSelectedAttribute' => Type::listOf(TypeContainer::selectedAttributes())
            ]
        ];
        parent::__construct($config);
    }
}
