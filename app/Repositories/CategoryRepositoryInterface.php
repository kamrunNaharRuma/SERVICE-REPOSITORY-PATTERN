<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function all();

    public function store(array $data);

    public function delete($id);

    public function edit($id);

    public function update(array $data, $id);
}
