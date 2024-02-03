<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return Inertia::render('Category/Index', [
            'categories' => $categories
        ]);
    }

    public function create()
    {
        return Inertia::render('Category/Create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'discount' => 'nullable|integer'
        ]);

        Category::query()->create($attributes);
        return redirect()->route('category');
    }
}
