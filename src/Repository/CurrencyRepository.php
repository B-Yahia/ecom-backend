<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class CurrencyRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getCurrencyId($id): array
    {
        return $this->conn->query('select label,symbole from Currencies where id=:id', ['id' => $id])->find();
    }
}
