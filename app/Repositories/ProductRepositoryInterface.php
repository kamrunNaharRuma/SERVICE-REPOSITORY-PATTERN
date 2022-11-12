<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    public function all();

    public function store(array $data);

    public function delete($id);

    public function edit($id);

    public function update(array $data, $productId);
}
