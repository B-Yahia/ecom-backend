<?php

declare(strict_types=1);

namespace Service;

use Entities\Price;
use Repository\RepositoryContainer;

class PriceService
{
    private $currencyService;
    private $priceRepo;

    public function __construct()
    {
        $this->currencyService = ServiceContainer::currency();
        $this->priceRepo = RepositoryContainer::price();;
    }

    public function getAllPricesByProductID($productId)
    {
        $listofPrices = [];
        $ids = $this->priceRepo->getProductPricesIds($productId);
        foreach ($ids as $priceId) {
            $priceData = $this->getPriceById($priceId);
            array_push($listofPrices, $priceData);
        }
        return $listofPrices;
    }

    public function getPriceById($id)
    {
        $priceData = $this->priceRepo->getPriceById($id);
        $priceData['currency'] = $this->currencyService->getCurrencyById($this->priceRepo->getPriceCurrencyId($id));
        $priceData['amount'] = (float)$priceData['amount'];
        return new Price($priceData);
    }
}
