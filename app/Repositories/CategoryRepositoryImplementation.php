<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\CategoryRepositoryInterface;

class CategoryRepositoryImplementation implements CategoryRepositoryInterface
{

    private $category;/*  */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->with('primaryCategory')->get();
    }


    public function store(array $data)
    {
        return $this->category->create($data);
    }

    public function delete($id)
    {
        return $this->category->where('id', $id)->delete();
    }

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(array $data, $categoryId)
    {
        return $this->category->where('id', $categoryId)->update($data);
    }
}
