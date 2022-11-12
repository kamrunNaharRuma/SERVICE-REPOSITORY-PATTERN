<?php

namespace App\Services;

use App\Models\Category;

interface CategoryServiceInterface
{

    public function all();

    public function store(array $data);

    public function delete($id);

    public function edit($id);

    public function update(array $data, int $categoryId);
}
