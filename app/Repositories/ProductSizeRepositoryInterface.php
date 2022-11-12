<?php

namespace App\Repositories;

interface ProductSizeRepositoryInterface
{
    public function store(array $sizeIds, int $productId);
}
