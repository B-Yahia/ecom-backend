<?php

declare(strict_types=1);

namespace Types;

final class TypeRegistry
{
    private static $price;
    private static $currency;
    private static $attribute;
    private static $product;
    private static $orderline;
    private static $selectedAttributes;
    private static $query;
    private static $mutation;

    public static function price()
    {
        return self::$price ?: (self::$price = new PriceType());
    }

    public static function currency()
    {
        return self::$currency ?: (self::$currency = new CurrencyType());
    }

    public static function attribute()
    {
        return self::$attribute ?: (self::$attribute = new AttributeType());
    }

    public static function attributeSet()
    {
        return self::$attribute ?: (self::$attribute = new AttributeSetType());
    }

    public static function product()
    {
        return self::$product ?: (self::$product = new ProductType());
    }

    public static function orderline()
    {
        return self::$orderline ?: (self::$orderline = new OrderlineType());
    }

    public static function selectedAttributes()
    {
        return self::$selectedAttributes ?: (self::$selectedAttributes = new SelectedAttributeType());
    }

    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }

    public static function mutation()
    {
        return self::$mutation ?: (self::$mutation = new MutationType());
    }
}
