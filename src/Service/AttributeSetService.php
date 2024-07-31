<?php

declare(strict_types=1);

namespace Service;

use Config\Database;
use Repository\AttributeSetRepository;

class AttributeSetService
{
    private $attributeService;
    private $attributeSetRepo;

    public function __construct()
    {
        $this->attributeService = new AttributeService();
        $this->attributeSetRepo = new AttributeSetRepository();
    }

    public function getAllAtrributeSetByProductId($productsId)
    {
        $listOfAttributeSets = [];
        $ids = $this->attributeSetRepo->getAttributeSetsIdsByProductId($productsId);
        foreach ($ids as $id) {
            $listOfAttributeSets[] = $this->getAttributeSetById($id);
        };
        return $listOfAttributeSets;
    }

    public function getAttributeSetById($id)
    {
        $attributeSet = $this->attributeSetRepo->getAttributeSetById($id);
        $attributeSet['attributes'] = $this->attributeService->getAllAttributesByAttributeSetId($attributeSet['id']);
        return $attributeSet;
    }
}
