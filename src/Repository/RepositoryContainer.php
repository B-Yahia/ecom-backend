<?php

declare(strict_types=1);

namespace Repository;


class RepositoryContainer
{
    private static $attributeRepository;
    private static $attributeSetRepository;
    private static $categoryRepository;
    private static $currencyRepository;
    private static $imagesUrlRepository;
    private static $priceRepository;
    private static $productRepository;
    private static $orderRepository;
    private static $orderlineRepository;
    private static $selectedAttributeRepository;


    public static function attribute()
    {
        return self::$attributeRepository ?: (self::$attributeRepository = new AttributeRepository());
    }
    public static function attributeSet()
    {
        return self::$attributeSetRepository ?: (self::$attributeSetRepository = new AttributeSetRepository());
    }
    public static function category()
    {
        return self::$categoryRepository ?: (self::$categoryRepository = new CategoryRepository());
    }
    public static function currency()
    {
        return self::$currencyRepository ?: (self::$currencyRepository = new CurrencyRepository());
    }
    public static function imageUrl()
    {
        return self::$imagesUrlRepository ?: (self::$imagesUrlRepository = new ImagesUrlRepository());
    }
    public static function price()
    {
        return self::$priceRepository ?: (self::$priceRepository = new PriceRepository());
    }
    public static function product()
    {
        return self::$productRepository ?: (self::$productRepository = new ProductRepository());
    }
    public static function order()
    {
        return self::$orderRepository ?: (self::$orderRepository = new OrderRepository());
    }
    public static function orderline()
    {
        return self::$orderlineRepository ?: (self::$orderlineRepository = new OrderlineRepository());
    }
    public static function selectedAttribute()
    {
        return self::$selectedAttributeRepository ?: (self::$selectedAttributeRepository = new SelectedAttributeRepository());
    }
}
