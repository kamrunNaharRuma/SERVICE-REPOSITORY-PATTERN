<?php

namespace App\Repositories;

use App\Models\ProductColor;

class ProductColorRepositoryImplementation implements ProductColorRepositoryInterface
{

    private $productColor;/*  */
    public function __construct(ProductColor $productColor)
    {
        $this->productColor = $productColor;
    }

    public function store(array $colorIds, int $productId)
    {
        foreach ($colorIds as $colorId) {
            $this->productColor->create([
                "product_id" => $productId,
                "color_id" => intval($colorId),
            ]);
        }
        return true;
    }
}
