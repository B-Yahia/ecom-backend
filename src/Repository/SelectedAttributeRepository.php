<?php

declare(strict_types=1);

namespace Repository;

class SelectedAttributeRepository extends AbstractRepository
{
    public function saveSelectedAttribute($data)
    {
        $this->conn->query('INSERT into SelectedAttributes (orderline_id ,attribute_id ,attributeSet_id ) values (:orderline_id ,:attribute_id ,:attributeSet_id )', [
            'orderline_id' => $data['orderline_id'],
            'attribute_id' => $data['attribute_id'],
            'attributeSet_id' => $data['attributeSet_id'],
        ]);
    }

    public function getAllSelectedAttributeByOrderlineId($id): array
    {
        return $this->conn->query('Select attribute_id ,attributeSet_id from SelectedAttributes where orderline_id=:id', ['id' => $id])->findAll();
    }
}
