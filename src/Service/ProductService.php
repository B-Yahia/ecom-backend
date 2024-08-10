<?php

declare(strict_types=1);

namespace Service;

use Config\Database;
use Entities\Product;
use Repository\CategoryRepository;
use Repository\ImagesUrlRepository;
use Repository\ProductRepository;
use Repository\RepositoryContainer;

class ProductService
{
    private $priceService;
    private $attributeSetService;
    private $imagesUrlRepo;
    private $productRepo;
    private $categoryRepo;

    public function __construct()
    {
        $this->priceService = ServiceContainer::price();
        $this->attributeSetService = ServiceContainer::attributeSet();
        $this->imagesUrlRepo = RepositoryContainer::imageUrl();
        $this->productRepo = RepositoryContainer::product();
        $this->categoryRepo = RepositoryContainer::category();
    }

    public function getProductById($id)
    {
        $productData = $this->productRepo->getProductDataById($id);
        $productData['category'] = $this->categoryRepo->getCategoryNameById($this->productRepo->getProductCategoryId($id));
        $productData['prices'] = $this->priceService->getAllPricesByProductID($id);
        $productData['gallery'] = $this->imagesUrlRepo->getProductImages($id);
        $productData['attributes'] = $this->attributeSetService->getAllAtrributeSetByProductId($id);
        return new Product($productData);
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

    public function getProductsByCategory(string $category)
    {
        $listOfProducts = [];
        $category_id = $this->categoryRepo->getCategoryIdByName($category);
        $ids = $this->productRepo->getProductsIdsByCategory($category_id);
        foreach ($ids as $id) {
            $listOfProducts[] = $this->getProductById($id);
        }
        return $listOfProducts;
    }
}
