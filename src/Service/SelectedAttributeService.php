<?php

declare(strict_types=1);

namespace Service;

use Entities\EntityContainer;
use Entities\SelectedAttributes;
use Repository\RepositoryContainer;

class SelectedAttributeService
{
    private $selectedAttributeRepo;
    private $attributeSetService;
    private $attributeService;

    public function __construct()
    {
        $this->selectedAttributeRepo = RepositoryContainer::selectedAttribute();
        $this->attributeService = ServiceContainer::attribute();
        $this->attributeSetService = ServiceContainer::attributeSet();
    }

    public function saveSelectedAttribute($data): SelectedAttributes
    {

        $this->selectedAttributeRepo->saveSelectedAttribute($data);

        return $this->getSelectedAttributeByAttributeIdAndAttributeSetId($data);
    }

    public function getSelectedAttributeByAttributeIdAndAttributeSetId($data): SelectedAttributes
    {
        return new SelectedAttributes([
            'attribute' => $this->attributeService->getAttributeById($data['attribute_id']),
            'attributeset' => $this->attributeSetService->getAttributeSetById($data['attributeSet_id']),
        ]);
    }
}
