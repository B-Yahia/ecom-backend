<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class ProductRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getAllProductsIds()
    {
        return $this->conn->query('Select id from Products')->findAllColumn();
    }

    public function getProductDataById($id)
    {
        return $this->conn->query('Select id,name,brand,description,inStock from Products where id=:id', ['id' => $id])->find();
    }

    public function getProductCategoryId($id)
    {
        return $this->conn->query('Select category_id from Products where id=:id', ['id' => $id])->findColumn();
    }
}
