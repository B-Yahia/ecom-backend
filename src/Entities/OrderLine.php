<?php

declare(strict_types=1);

namespace Entities;

class OrderLine
{
    protected $id;
    private Product $product;
    private int $quantity;
    private array $listOfSeletedAttributes;
}
