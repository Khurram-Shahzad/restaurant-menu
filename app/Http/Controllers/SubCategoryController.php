<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Services\CategoryService;
use App\Services\SubCategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SubCategoryController extends Controller
{
    private CategoryService $categoryService;
    private SubCategoryService $subCategoryService;

    public function __construct(CategoryService $categoryService, SubCategoryService $subCategoryService)
    {
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $subCategories = $this->subCategoryService->subCategories();
        return Inertia::render('SubCategory/Index', [
            'subCategories' => $subCategories
        ]);
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return Inertia::render('SubCategory/Create', [
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'category_id' => 'required',
            'parent_subcategory_id' => 'nullable|integer',
            'name' => 'required'
        ]);
        SubCategory::query()->create($attributes);
        return redirect()->route('subcategory');
    }

    public function getSubCategoriesByCategoryId($categoryId)
    {
        return $this->categoryService->getSubCategoriesByCategoryId($categoryId);
    }
}
