<?php

declare(strict_types=1);

namespace Repository;

use Config\Setup;

class AttributeRepository
{
    private $conn;

    public function __construct()
    {
        $this->conn = Setup::database();
    }

    public function getAttributeById($id)
    {
        return $this->conn->query('Select id,value,displayed_value from Attributes where id=:id', ['id' => $id])->find();
    }

    public function getAttributesIdsByAttributeSetId($id): array
    {
        return $this->conn->query('select id from Attributes where attribute_set_id=:id', ['id' => $id])->findAllColumn();
    }
}
