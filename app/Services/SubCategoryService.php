<?php

namespace App\Services;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Collection;

class SubCategoryService
{
    public function subCategories(): Collection|array
    {
        return SubCategory::query()
            ->with('category','children')
            ->get();
    }
}
