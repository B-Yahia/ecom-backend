<?php

declare(strict_types=1);

namespace Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

require __DIR__ . "/../../vendor/autoload.php";

class SelectedAttributeType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'attribute' => TypeContainer::attribute(),
                'attributeset' => TypeContainer::attributeSet(),
            ],
        ];

        parent::__construct($config);
    }
}
