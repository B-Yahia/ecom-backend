<?php

declare(strict_types=1);

namespace Entities;

class Product
{
    protected $id;
    private string $name;
    private $inStock;
    private array $gallery;
    private string $description;
    private Category $category;
    private array $attributeSets;
    private array $prices;
    private string $brand;
}
