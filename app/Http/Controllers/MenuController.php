<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Services\CategoryService;
use App\Services\ItemService;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenuController extends Controller
{
    private MenuService $menuService;
    private CategoryService $categoryService;
    private ItemService $itemService;

    public function __construct(MenuService $menuService, CategoryService $categoryService, ItemService $itemService)
    {
        $this->menuService = $menuService;
        $this->categoryService = $categoryService;
        $this->itemService = $itemService;
    }

    public function index()
    {
        $menus = $this->menuService->getAllMenus();
        return Inertia::render('Menu/Index', [
            'menus' => $menus
        ]);
    }

    public function create()
    {
        return Inertia::render('Menu/Create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required'
        ]);
        Menu::query()->create($attributes);
        return redirect()->route('menu');
    }

    public function addMenuItem()
    {
        $menus = $this->menuService->getAllMenus();
        $items = $this->itemService->getAllItems();
        return Inertia::render('Menu/Add-Items', [
            'menus' => $menus,
            'items' => $items
        ]);
    }

    public function storeMenuItem()
    {
        request()->validate([
            'menu_id' => 'required',
            'item_id' => 'required'
        ]);

        Menu::query()->find(request('menu_id'))->items()->attach(request('item_id'));
        return redirect()->route('menu');
    }
}
