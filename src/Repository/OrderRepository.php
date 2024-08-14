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
        return $this->conn->query('Insert into Orders (total) values (:total)', ['total' => $amount])->id();
    }

    public function getOrderTotal($id)
    {
        return $this->conn->query('SELECT total from Orders where id=:id', ['id' => $id])->findColumn();
    }
}
