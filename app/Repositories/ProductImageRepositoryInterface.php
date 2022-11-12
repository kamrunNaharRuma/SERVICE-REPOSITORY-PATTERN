<?php

namespace App\Repositories;

interface ProductImageRepositoryInterface
{
    public function store(array $imageIds, int $productId);
}
