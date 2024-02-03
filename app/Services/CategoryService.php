<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function getAllCategories(): Collection|array
    {
        return Category::query()
            ->with('subCategories.children', 'subCategories.items', 'items')
            ->get();
    }

    public function getSubCategoriesByCategoryId($categoryId)
    {
        $category =  Category::query()
            ->with('subCategories')
            ->where('id', $categoryId)
            ->firstOrFail();
        return $category->subCategories;
    }
}
