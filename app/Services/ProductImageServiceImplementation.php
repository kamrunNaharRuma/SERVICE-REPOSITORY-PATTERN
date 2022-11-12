<?php

namespace App\Services;

use App\Repositories\ProductImageRepositoryInterface;

class ProductImageServiceImplementation implements ProductImageServiceInterface
{

    private $productImage;/*  */
    public function __construct(ProductImageRepositoryInterface $productImage)
    {
        $this->productImage = $productImage;
    }

    public function store(array $images, int $productId)
    {
        return $this->productImage->store($images, $productId);
    }
}
