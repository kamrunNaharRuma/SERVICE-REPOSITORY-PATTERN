<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryServiceInterface;

class CategoryServiceImplementation implements CategoryServiceInterface
{

    private $category;/*  */
    public function __construct(CategoryRepositoryInterface $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->all();
    }

    public function store(array $data)
    {
        return $this->category->store($data);
    }

    public function delete($id)
    {
        return $this->category->delete($id);
    }

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(array $data, Category $category)
    {
        return $this->category->update($data, $category);
    }
}
