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
                'test' => [
                    'type' => Type::boolean(),
                    'args' => [
                        'order' => ['type' => Type::string()],
                    ],
                    'resolve' => function ($root, $args) {
                        // $orderService = ServiceContainer::order();
                        // return $orderService->saveOrder($args['order']);
                        echo var_dump($args);
                        return true;
                    }
                ],
                'test1' => [
                    'type' => Type::string(),
                    'args' => [
                        'name' => ['type' => Type::string()],
                    ],
                    'resolve' => function ($root, $args) {
                        return 'hello' . $args['name'];
                    }
                ],
                'test2' => [
                    'type' => Type::string(),
                    'args' => [
                        'product' => ['type' => InputTypeContainer::product()],
                    ],
                    'resolve' => function ($root, $args) {
                        return 'Product name is ' . $args['produc']['name'];
                    }
                ]
            ],
        ];
        parent::__construct($config);
    }
}
