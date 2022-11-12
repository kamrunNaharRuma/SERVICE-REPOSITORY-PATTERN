<?php

namespace App\Services;

interface ProductImageServiceInterface
{
    public function store(array $images, int $productId);
}
