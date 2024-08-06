<?php

declare(strict_types=1);

namespace Service;

use Config\Database;
use Entities\AttributeSet;
use Repository\AttributeSetRepository;
use Repository\RepositoryContainer;

class AttributeSetService
{
    private $attributeService;
    private $attributeSetRepo;

    public function __construct()
    {
        $this->attributeService = ServiceContainer::attribute();
        $this->attributeSetRepo = RepositoryContainer::attributeSet();
    }

    public function getAllAtrributeSetByProductId($productsId): array
    {
        $listOfAttributeSets = [];
        $ids = $this->attributeSetRepo->getAttributeSetsIdsByProductId($productsId);
        foreach ($ids as $id) {
            $listOfAttributeSets[] = $this->getAttributeSetById($id);
        };
        return $listOfAttributeSets;
    }

    public function getAttributeSetById($id): AttributeSet
    {
        $attributeSet = $this->attributeSetRepo->getAttributeSetById($id);
        $attributeSet['items'] = $this->attributeService->getAllAttributesByAttributeSetId($attributeSet['id']);
        return new AttributeSet($attributeSet);
    }
}
