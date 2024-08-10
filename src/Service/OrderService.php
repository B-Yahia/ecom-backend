<?php

declare(strict_types=1);

namespace Service;

use Repository\RepositoryContainer;

class OrderService
{
    private $orderRepo;
    private $orderlineService;
    public function __construct()
    {
        $this->orderRepo = RepositoryContainer::order();
        $this->orderlineService = ServiceContainer::orderline();
    }
    public function saveOrder($data)
    {
        $id = $this->orderRepo->saveOrder($data['amount']);
        foreach ($data['orderlines'] as $orderline) {
            $this->orderlineService->saveOrderline(
                [
                    'order_id' => $id,
                    'orderline' => $orderline,
                ]
            );
        }
    }
}
