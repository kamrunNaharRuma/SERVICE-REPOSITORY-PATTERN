<?php

namespace App\Services;

use App\Repositories\ProductSizeRepositoryInterface;

class ProductSizeServiceImplementation implements ProductSizeServiceInterface
{

    private $productSize;/*  */
    public function __construct(ProductSizeRepositoryInterface $productSize)
    {
        $this->productSize = $productSize;
    }

    public function store(array $sizeIds, int $productId)
    {
        return $this->productSize->store($sizeIds, $productId);
    }
}
