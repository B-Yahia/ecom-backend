<?php

declare(strict_types=1);

namespace Service;

use Repository\RepositoryContainer;

class SelectedAttributeService
{
    private $selectedAttributeRepo;
    public function __construct()
    {
        $this->selectedAttributeRepo = RepositoryContainer::selectedAttribute();
    }

    public function saveSelectedAttribute($data)
    {
        $this->selectedAttributeRepo->saveSelectedAttribute($data);
    }
}
