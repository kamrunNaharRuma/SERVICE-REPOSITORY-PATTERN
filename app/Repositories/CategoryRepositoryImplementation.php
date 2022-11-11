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
        return $this->category->get();
    }


    public function store(array $data)
    {
        return $this->category->insert([...$data, "created_at" => now()]);
    }

    public function delete($id)
    {
        return $this->category->delete($id);
    }

    public function edit($id)
    {
        return $this->category->edit($id);
    }

    public function update(array $data, $category)
    {
        return $this->category->where('id', $category->id)->update($data);
    }
}
