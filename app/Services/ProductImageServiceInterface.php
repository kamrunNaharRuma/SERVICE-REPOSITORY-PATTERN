<?php

namespace App\Services;

interface ProductSizeServiceInterface
{
    public function store(array $sizeIds, int $productId);
}
