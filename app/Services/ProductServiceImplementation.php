<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductServiceInterface;

class ProductServiceImplementation implements ProductServiceInterface
{

    private $product;/*  */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->all();
    }

    public function store(array $data)
    {
        return $this->product->store($data);
    }

    public function delete($id)
    {
        return $this->product->delete($id);
    }

    public function edit($id)
    {
        return $this->product->edit($id);
    }

    public function update(array $data, Product $product)
    {
        return $this->product->update($data, $product);
    }
}
