<?php

declare(strict_types=1);

namespace Service;

use Repository\AttributeRepository;

class AttributeService
{
    private $attributeRepo;


    public function __construct()
    {
        $this->attributeRepo = new AttributeRepository();
    }

    public function getAllAttributesByAttributeSetId($attributeSetId): array
    {
        $listOfAttributes = [];
        $ids = $this->attributeRepo->getAttributesIdsByAttributeSetId($attributeSetId);
        foreach ($ids as $id) {
            $attribute = $this->attributeRepo->getAttributeById($id);
            $listOfAttributes[] = $attribute;
        }
        return $listOfAttributes;
    }
}
