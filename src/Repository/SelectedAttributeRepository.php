<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class SelectedAttributeRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }
    public function saveSelectedAttribute($data)
    {
        $this->conn->query('INSERT into SelectedAttributes (orderline_id ,attribute_id ,attribute_set_id ) values (:orderline_id ,:attribute_id ,:attribute_set_id )', [
            'orderline_id' => $data['orderline_id'],
            'attribute_id' => $data['attribute_id'],
            'attribute_set_id' => $data['attribute_set_id'],
        ]);
    }
}
