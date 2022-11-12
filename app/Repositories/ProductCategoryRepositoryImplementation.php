<?php

namespace App\Repositories;

use App\Models\ProductCategory;

class ProductCategoryRepositoryImplementation implements ProductCategoryRepositoryInterface
{

    private $productCategory;/*  */
    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function store(array $categoryIds, int $productId)
    {
        $this->deleteDuplicateProductCategory($productId);
        foreach ($categoryIds as $categoryId) {
            $this->productCategory->create([
                "product_id" => $productId,
                "category_id" => intval($categoryId),
            ]);
        }
        return true;
    }
    private function deleteDuplicateProductCategory($productId)
    {
        return $this->productCategory->where('product_id', $productId)->delete();
    }
}
