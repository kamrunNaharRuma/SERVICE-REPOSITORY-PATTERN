<?php

namespace App\Services;

interface ProductCategoryServiceInterface
{
    public function store(array $categoryIds, int $productId);
}
