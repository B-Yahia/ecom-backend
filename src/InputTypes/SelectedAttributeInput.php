<?php

declare(strict_types=1);

namespace InputTypes;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class SelectedAttributeInput extends InputObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => [
                'attributeSet' => Type::nonNull(new AttributeSetInput()),
                'attribute' => Type::nonNull(new AttributeInput())
            ],
        ];
        parent::__construct($config);
    }
}
