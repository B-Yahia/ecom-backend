<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class ImagesUrlRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getProductImages($id): array
    {
        return $this->conn->query('Select url from ImagesUrls where product_id=:id', ['id' => $id])->findAllColumn();
    }
}
