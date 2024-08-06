<?php

declare(strict_types=1);

namespace Service;

class ServiceContainer
{
    private static $attributeService;
    private static $attributeSetService;
    private static $currencyService;
    private static $priceService;
    private static $productService;

    public static function attribute()
    {
        return self::$attributeService ?: (self::$attributeService = new AttributeService());
    }
    public static function attributeSet()
    {
        return self::$attributeSetService ?: (self::$attributeSetService = new AttributeSetService());
    }
    public static function currency()
    {
        return self::$currencyService ?: (self::$currencyService = new CurrencyService());
    }
    public static function price()
    {
        return self::$priceService ?: (self::$priceService = new PriceService());
    }
    public static function product()
    {
        return self::$productService ?: (self::$productService = new ProductService());
    }
}
