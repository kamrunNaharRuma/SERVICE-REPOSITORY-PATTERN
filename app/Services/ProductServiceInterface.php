<?php

namespace App\Services;

use App\Models\Product;

interface ProductServiceInterface
{

    public function all();

    public function store(array $data);

    public function delete($id);

    public function edit($id);

    public function update(array $data, Product $product);
}
