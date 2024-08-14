<?php

declare(strict_types=1);

namespace Service;

use Entities\Order;
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
    public function saveOrder($data): Order
    {
        $id = $this->orderRepo->saveOrder($data['total']);
        $savedOrderlines = [];
        foreach ($data['orderlines'] as $orderline) {
            $savedOrderlines[] = $this->orderlineService->saveOrderline(
                [
                    'order_id' => $id,
                    'orderline' => $orderline,
                ]
            );
        }

        return new Order([
            'id' => $id,
            'total' => $data['total'],
            'orderlines' => $savedOrderlines,
        ]);
    }

    public function getOrderById($data)
    {
        return 1;
    }
}
