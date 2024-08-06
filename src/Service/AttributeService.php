<?php

declare(strict_types=1);

namespace Service;

use Entities\Attribute;
use Repository\AttributeRepository;
use Repository\RepositoryContainer;

class AttributeService
{
    private $attributeRepo;


    public function __construct()
    {
        $this->attributeRepo = RepositoryContainer::attribute();
    }

    public function getAllAttributesByAttributeSetId($attributeSetId): array
    {
        $listOfAttributes = [];
        $ids = $this->attributeRepo->getAttributesIdsByAttributeSetId($attributeSetId);
        foreach ($ids as $id) {
            $listOfAttributes[] = $this->getAttributeById($id);
        }
        return $listOfAttributes;
    }

    public function getAttributeById($id): Attribute
    {
        return new Attribute($this->attributeRepo->getAttributeById($id));
    }
}
