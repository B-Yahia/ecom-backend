<?php

declare(strict_types=1);

namespace Service;

use Entities\Attributeset;
use Exception;
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

    public function getAttributeSetById($id): Attributeset
    {
        $attributeSet = $this->attributeSetRepo->getAttributeSetById($id);
        $attributeSet['items'] = $this->attributeService->getAllAttributesByAttributeSetId($attributeSet['id']);
        return new Attributeset($attributeSet);
    }
}
