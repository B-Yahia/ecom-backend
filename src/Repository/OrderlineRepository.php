<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class OrderlineRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function saveOrderLine($data)
    {
        return $this->conn->query('INSERT into Orderlines (product_id,count,order_id)values(:product_id,:units,:order_id)', [
            'product_id' => $data['product_id'],
            'units' => $data['units'],
            'order_id' => $data['order_id']
        ])->id();
    }
    public function getOrderlineById($id)
    {
        return $this->conn->query('Select product_id,count from Orderlines where id=:id', ['id' => $id])->find();
    }
    public function getOrderlinesIdsByOrderId($id)
    {
        return $this->conn->query('Select id from Orderlines where order_id=:id', ['id' => $id])->findAllColumn();
    }
}
