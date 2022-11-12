<?php

namespace App\Repositories;

use App\Models\ProductSize;

class ProductSizeRepositoryImplementation implements ProductSizeRepositoryInterface
{

    private $productSize;/*  */
    public function __construct(ProductSize $productSize)
    {
        $this->productSize = $productSize;
    }

    public function store(array $sizeIds, int $productId)
    {
        foreach ($sizeIds as $sizeId) {
            $this->productSize->create([
                "product_id" => $productId,
                "size_id" => intval($sizeId),
            ]);
        }
        return true;
    }
}
