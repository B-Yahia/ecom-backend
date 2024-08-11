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
                    'type' => Type::id(),
                    'args' => [
                        'order' => ['type' => InputTypeContainer::order()],
                    ],
                    'resolve' => function ($root, $args) {
                        // $orderService = ServiceContainer::order();

                        // $orderService->saveOrder($args['order']);

                        return 'Here is the recieved data : ' . $args['order']['orderlines'][0]['product']['id'];
                    }
                ]
            ],
        ];
        parent::__construct($config);
    }
}
