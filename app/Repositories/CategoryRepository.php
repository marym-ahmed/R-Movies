<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function all()
    {
        return $this->category->all();
    }

    public function create(array $data)
    {
        return $this->category->create($data);
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function update(Category $category, array $data)
    {
        return $category->fill($data)->save();
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function search($keyword)
    {
        return $this->category->where('category', 'LIKE', "%{$keyword}%")->get();
    }
}
