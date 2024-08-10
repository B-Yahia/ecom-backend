<?php

declare(strict_types=1);

namespace Service;

use Repository\RepositoryContainer;

class OrderlineService
{
    private $orderlineRepo;
    private $selectedAttributeService;
    public function __construct()
    {
        $this->orderlineRepo = RepositoryContainer::orderline();
        $this->selectedAttributeService = ServiceContainer::selectedAttributes();
    }
    public function saveOrderline($data)
    {
        $id = $this->orderlineRepo->saveOrderLine([
            'order_id' => $data['order_id'],
            'units' => $data['orderline']['units'],
            'product_id' => $data['orderline']['product']['id']
        ]);
        foreach ($data['selectedAttributes'] as $selectedAttribute) {
            $this->selectedAttributeService->saveSelectedAttribute([
                'orderline_id' => $id,
                'attributeSet_id' => $selectedAttribute['attributeSet']['id'],
                'attribute_id' => $selectedAttribute['attribute']['id']
            ]);
        }
    }
}
