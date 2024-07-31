<?php

declare(strict_types=1);

namespace Entities;


class Order
{
    protected $id;
    private array $orderLines;
    private float $total;
}
