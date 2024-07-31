<?php

declare(strict_types=1);

namespace Service;

use Config\Database;
use Repository\CurrencyRepository;

class CurrencyService
{
    private $currencyRepo;

    public function __construct()
    {
        $this->currencyRepo = new CurrencyRepository();
    }

    public function getCurrencyById($id): array
    {
        return $this->currencyRepo->getCurrencyId($id);
    }
}
