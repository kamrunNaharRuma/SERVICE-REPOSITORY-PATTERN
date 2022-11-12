<?php

namespace App\Services;

use App\Repositories\ProductColorRepositoryInterface;

class ProductColorServiceImplementation implements ProductColorServiceInterface
{

    private $productColor;/*  */
    public function __construct(ProductColorRepositoryInterface $productColor)
    {
        $this->productColor = $productColor;
    }

    public function store(array $colorIds, int $productId)
    {
        return $this->productColor->store($colorIds, $productId);
    }
}
