<?php

declare(strict_types=1);

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'sum' => [
                    'type' => Type::int(),
                    'args' => [
                        'x' => ['type' => Type::int()],
                        'y' => ['type' => Type::int()],
                    ],
                    'resolve' => static fn ($calc, array $args): int => $args['x'] + $args['y'],
                ],
            ],
        ];
        parent::__construct($config);
    }
}
