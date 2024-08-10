<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class OrderRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function saveOrder($amount)
    {
        return $this->conn->query('Insert into Orders (amount) values (:amount)', ['amount' => $amount])->id();
    }
}
