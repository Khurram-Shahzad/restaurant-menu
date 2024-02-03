<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Services\CategoryService;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    private ItemService $itemService;
    private CategoryService $categoryService;

    public function __construct(ItemService $itemService, CategoryService $categoryService)
    {
        $this->itemService = $itemService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $items =  $this->itemService->getAllItems();
        return Inertia::render('Item/Index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return Inertia::render('Item/Create', [
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'category_id' => 'required',
            'sub_category_id' => 'nullable|integer',
            'name' => 'required'
        ]);
        Item::query()->create($attributes);
        return redirect()->route('item');
    }
}
