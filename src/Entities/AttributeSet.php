<?php

declare(strict_types=1);

namespace Entities;

use GraphQL\Utils\Utils;

class AttributeSet
{
    public $id;
    public string $name;
    public string $type;
    public array $items;

    public function __construct(array $data)
    {
        Utils::assign($this, $data);
    }
}