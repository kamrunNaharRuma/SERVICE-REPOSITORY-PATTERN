<?php

namespace App\Services;

interface ProductColorServiceInterface
{
    public function store(array $colorIds, int $productId);
}
