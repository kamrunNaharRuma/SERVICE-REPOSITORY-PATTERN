<?php

namespace App\Services;

use App\Repositories\ProductCategoryRepositoryInterface;

class ProductCategoryServiceImplementation implements ProductCategoryServiceInterface
{

    private $productCategory;/*  */
    public function __construct(ProductCategoryRepositoryInterface $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function store(array $categoryIds, int $productId)
    {
        return $this->productCategory->store($categoryIds, $productId);
    }
}
