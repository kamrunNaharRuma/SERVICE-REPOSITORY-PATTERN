<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\ProductRepositoryInterface;

class ProductRepositoryImplementation implements ProductRepositoryInterface
{

    private $product;/*  */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function all()
    {
        return $this->product->with(
            'productCategory',
            'images',
            'availableColors.color',
            'availableSizes.size'
        )->get();
    }


    public function store(array $data)
    {
        return $this->product->create([
            "name" => $data['name'],
            "slug" => $data['slug'],
            "price" => $data['price'],
            "created_at" => now()
        ]);
    }

    public function delete($id)
    {
        return $this->product->where('id', $id)->delete();
    }

    public function edit($id)
    {
        return $this->product->edit($id);
    }

    public function update(array $data, $product)
    {

        $dataToUpdate = [
            "name" => isset($data["name"]) ? $data["name"] : $product["name"],
            "slug" => isset($data["slug"]) ? $data["slug"] : $product["slug"],
            "price" => isset($data["price"]) ? $data["price"] : $product["price"]
        ];
        return $this->product
            ->where('id', $product->id)
            ->update($dataToUpdate);
    }
}
