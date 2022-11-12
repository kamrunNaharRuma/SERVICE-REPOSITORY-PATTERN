<?php

namespace App\Repositories;

interface ProductColorRepositoryInterface
{
    public function store(array $colorIds, int $productId);
}
