<?php

declare(strict_types=1);

namespace Types;

use Entities\Currency;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Repository\CurrencyRepository;
use Service\ServiceContainer;

class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'product' => [
                    'type' => TypeContainer::product(),
                    'args' => [
                        'id' => ['type' => Type::nonNull(Type::id())],
                    ],
                    'resolve' => function ($root, $args) {
                        $productService = ServiceContainer::product();
                        return $productService->getProductById($args['id']);
                    }
                ],
                'products' => [
                    'type' => Type::listOf(TypeContainer::product()),
                    'args' => [
                        'category' => Type::string(),
                    ],
                    'resolve' => function ($root, $args) {
                        $productService = ServiceContainer::product();
                        if ($args['category'] == 'tech' || $args['category'] == 'clothes') {
                            return $productService->getProductsByCategory($args['category']);
                        } else {
                            return $productService->getAllProducts();
                        }
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}
