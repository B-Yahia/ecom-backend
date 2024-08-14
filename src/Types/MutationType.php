<?php

declare(strict_types=1);

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use InputTypes\InputTypeContainer;
use Service\ServiceContainer;

class MutationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'addOrder' => [
                    'type' => Type::string(),
                    'args' => [
                        'order' => ['type' => InputTypeContainer::order()],
                    ],
                    'resolve' => function ($root, $args) {
                        $orderService = ServiceContainer::order();
                        $order = $orderService->saveOrder($args['order']);
                        return "hello";
                    }
                ],
                'test' => [
                    'type' => Type::string(),
                    'args' => [
                        'id' => ['type' => Type::id()],
                    ],
                    'resolve' => function ($root, $args) {
                        echo var_dump($args);
                        return "hello " . $args['id'];
                    }
                ]

            ],
        ];
        parent::__construct($config);
    }
}
