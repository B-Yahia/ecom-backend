<?php

declare(strict_types=1);

use Config\Setup;

require __DIR__ . "/../vendor/autoload.php";

// read json file
$data = file_get_contents(__DIR__ . '/../util/Data.json');
//convert content to an assoc array
$decoded_data = json_decode($data, true);
//extract products
$list_of_products = $decoded_data['data']['products'];
//create connection instance 
$conn = Setup::database();

foreach ($list_of_products as $product) {
    $existing_product = $conn->query(
        'SELECT id FROM Products WHERE name = :name AND brand = :brand',
        [
            'name' => $product['name'],
            'brand' => $product['brand']
        ]
    )->find();

    if ($existing_product) {
        echo $product['name'] . "already persisted";
        // Skip this product as it already exists
        continue;
    }
    //get category id 
    $catgory_id = $conn->query(
        'select id from Categories where name = :name',
        [
            'name' => $product['category']
        ]
    )->find();

    $product_id = $conn->query("insert into Products (name ,brand,description,in_stock,category_id) values (:name ,:brand,:description,:in_stock,:category_id)", [
        'name' => $product['name'],
        'brand' => $product['brand'],
        'in_stock' => $product['inStock'] ? 1 : 0,
        'description' => $product['description'],
        'category_id' => $catgory_id['id'],
    ])->id();
    if ($product['gallery']) {
        foreach ($product['gallery'] as $img_url) {
            // insert images
            $conn->query("insert into ImagesUrls (url,product_id) values (:url,:product_id)", [
                'url' => $img_url,
                'product_id' => $product_id,
            ]);
        }
    }
    if ($product['attributes']) {
        foreach ($product['attributes'] as $attribute_set) {
            //insert attributeSets and 
            $attribute_set_id = $conn->query("insert into AttributeSets (name,type,product_id) values (:name,:type,:product_id)", [
                'name' => $attribute_set['name'],
                'type' => $attribute_set['type'],
                'product_id' => $product_id,
            ])->id();
            if ($attribute_set['items']) {
                foreach ($attribute_set['items'] as $attribute) {
                    $conn->query("insert into Attributes (value,displayed_value,attribute_set_id) values (:value,:displayed_value,:attribute_set_id)", [
                        'value' => $attribute['value'],
                        'displayed_value' => $attribute['displayValue'],
                        'attribute_set_id' => $attribute_set_id,
                    ]);
                }
            }
        }
    }
    if ($product['prices']) {
        foreach ($product['prices'] as $price) {
            $currency_id = $conn->query(
                'select id from Currencies where label = :label',
                [
                    'label' => $price['currency']['label']
                ]
            )->find();
            // insert images
            $conn->query("insert into Prices (amount,currency_id,product_id) values (:amount,:currency_id,:product_id)", [
                'amount' => $price['amount'],
                'currency_id' => $currency_id['id'],
                'product_id' => $product_id,
            ]);
        }
    }
}

die('Data stored');
