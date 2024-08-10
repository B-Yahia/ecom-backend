<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class CategoryRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getCategoryNameById($id)
    {
        return $this->conn->query('Select name from Categories where id=:id', ['id' => $id])->findColumn();
    }
    public function getCategoryIdByName($name)
    {
        return $this->conn->query('Select id from Categories where name=:name', ['name' => $name])->findColumn();
    }
}
