<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class PriceRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getProductPricesIds($id): array
    {
        return $this->conn->query('select id from Prices where product_id=:id', ['id' => $id])->findAllColumn();
    }

    public function getPriceById($id): array
    {
        return $this->conn->query('select amount from Prices where id=:id', ['id' => $id])->find();
    }

    public function getPriceCurrencyId($id): int
    {
        return $this->conn->query('select currency_id from Prices where id=:id', ['id' => $id])->findColumn();
    }
}
