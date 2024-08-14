<?php

declare(strict_types=1);

namespace Entities;

use GraphQL\Utils\Utils;

class Orderline
{
    public $id;
    public Product $product;
    public int $units;
    public array $seletedAttributes;

    public function __construct(array $data)
    {
        Utils::assign($this, $data);
    }
}
