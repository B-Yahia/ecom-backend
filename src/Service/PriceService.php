<?php

declare(strict_types=1);

namespace Service;

use Repository\PriceRepository;

class PriceService
{
    private $currencyService;
    private $priceRepo;

    public function __construct()
    {
        $this->currencyService = new CurrencyService();
        $this->priceRepo = new PriceRepository();
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
        return $priceData;
    }
}
