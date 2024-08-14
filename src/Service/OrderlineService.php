<?php

declare(strict_types=1);

namespace Service;

use Entities\Orderline;
use Repository\RepositoryContainer;

class OrderlineService
{
    private $orderlineRepo;
    private $selectedAttributeService;
    private $productService;
    public function __construct()
    {
        $this->orderlineRepo = RepositoryContainer::orderline();
        $this->selectedAttributeService = ServiceContainer::selectedAttributes();
        $this->productService = ServiceContainer::product();
    }
    public function saveOrderline($data): Orderline
    {
        $id = $this->orderlineRepo->saveOrderLine([
            'order_id' => $data['order_id'],
            'units' => $data['orderline']['units'],
            'product_id' => $data['orderline']['product']['id']
        ]);
        $savedSelectedAttribute = [];
        foreach ($data['orderline']['selectedAttributes'] as $selectedAttribute) {

            $savedSelectedAttribute[] = $this->selectedAttributeService->saveSelectedAttribute([
                'orderline_id' => $id,
                'attributeSet_id' => $selectedAttribute['attributeSet']['id'],
                'attribute_id' => $selectedAttribute['attribute']['id']
            ]);
        }


        $product = $this->productService->getProductById($data['orderline']['product']['id']);
        $orderlineEntity = new Orderline([
            'id' => $id,
            'product' => $product,
            'units' => $data['orderline']['units'],
            'seletedAttributes' => $savedSelectedAttribute
        ]);

        return $orderlineEntity;
    }

    public function getOrderlineById($id): Orderline
    {
        $data = $this->orderlineRepo->getOrderlineById($id);
        $product = $this->productService->getProductById($data['product_id']);
        return new Orderline(
            [
                'id' => $id,
                'units' => $data['units'],
                'product' => $product
            ]
        );
    }
}
