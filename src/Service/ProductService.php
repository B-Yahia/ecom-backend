<?php

declare(strict_types=1);

namespace Service;

use Config\Database;
use Repository\CategoryRepository;
use Repository\ImagesUrlRepository;
use Repository\ProductRepository;

class ProductService
{
    private $priceService;
    private $attributeSetService;
    private $imagesUrlRepo;
    private $productRepo;
    private $categoryRepo;

    public function __construct()
    {
        $this->priceService = new PriceService();
        $this->attributeSetService = new AttributeSetService();
        $this->imagesUrlRepo = new ImagesUrlRepository();
        $this->productRepo = new ProductRepository();
        $this->categoryRepo = new CategoryRepository();
    }

    public function getProductById($id)
    {
        $productData = $this->productRepo->getProductDataById($id);
        $productData['category'] = $this->categoryRepo->getCategoryNameById($this->productRepo->getProductCategoryId($id));
        $productData['prices'] = $this->priceService->getAllPricesByProductID($id);
        $productData['gallery'] = $this->imagesUrlRepo->getProductImages($id);
        $productData['attributeSets'] = $this->attributeSetService->getAllAtrributeSetByProductId($id);
        return $productData;
    }

    public function getAllProducts()
    {
        $listOfProducts = [];
        $ids = $this->productRepo->getAllProductsIds();
        foreach ($ids as $id) {
            $listOfProducts[] = $this->getProductById($id);
        }
        return $listOfProducts;
    }
}
