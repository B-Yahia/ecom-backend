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

    public function saveOrder($total)

    {
        return $this->conn->query('Insert into Orders (total) values (:total)', ['total' => $total])->id();
    }
}
