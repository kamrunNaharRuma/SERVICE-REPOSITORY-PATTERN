<?php

namespace App\Repositories;

use App\Models\ProductImage;

class ProductImageRepositoryImplementation implements ProductImageRepositoryInterface
{

    private $productImage;/*  */
    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
    }

    public function store(array $images, int $productId)
    {
        foreach ($images as $image) {
            $name = time() . $image->getClientOriginalName();
            $image->move(public_path('productImages'), $name);
            $this->productImage->create([
                "product_id" => $productId,
                "path" => public_path('productImages') . $name,
            ]);
        }
        return true;
    }
}
