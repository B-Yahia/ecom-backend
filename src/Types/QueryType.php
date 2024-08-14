<?php

declare(strict_types=1);

namespace Types;

use Entities\Currency;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use Repository\CurrencyRepository;
use Service\ServiceContainer;

use function PHPSTORM_META\type;

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
                ],
                'getSelectedAttribute' => [
                    'type' => TypeContainer::selectedAttributes(),
                    'resolve' => function ($root, $args) {
                        $selectedAttributeService = ServiceContainer::selectedAttributes();
                        $var = $selectedAttributeService->getSelectedAttributeByAttributeAndAttributeSetIDS(
                            [
                                'attribute_id' => 1,
                                'attributeSet_id' => 1,
                            ]
                        );
                        return $var;
                    }
                ],
                'getOrderline' => [
                    'type' => TypeContainer::orderline(),
                    'resolve' => function ($root, $args) {
                        $orderlineService = ServiceContainer::orderline();
                        return $orderlineService->getOrderlineById(2);
                    }
                ],
                'getOrder' => [
                    'type' => TypeContainer::order(),
                    'resolve' => function ($root, $args) {
                        $orderlineService = ServiceContainer::order();
                        $var = $orderlineService->getOrderById(3);
                        // echo var_dump($var);
                        return $var;
                    }
                ]

            ]
        ];
        parent::__construct($config);
    }
}
