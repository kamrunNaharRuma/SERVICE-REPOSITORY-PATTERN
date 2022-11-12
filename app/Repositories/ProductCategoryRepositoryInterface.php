<?php

namespace App\Repositories;

interface ProductCategoryRepositoryInterface
{
    public function store(array $categoryIds, int $productId);
}
