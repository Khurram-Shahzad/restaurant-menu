<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function getAllMenus()
    {
        return Menu::query()->get();
    }

    public function getAllMenusWithDiscount(): Collection|array
    {
        $menus = Menu::query()
            ->with('items', 'items.category', 'items.subCategory')
            ->get();
        return $this->computeDiscount($menus);
    }

    public function computeDiscount($menus): array
    {
        $menuWithDiscount = [];
        foreach ($menus as $menu) {
            foreach ($menu->items as $item) {
                $discount = $this->calculateDiscountForItem($item);
                $menuWithDiscount[$menu->name][$item->id]['name'] = $item->name;
                $menuWithDiscount[$menu->name][$item->id]['discount'] = $discount;
            }
        }
        return $menuWithDiscount;
    }

    public function calculateDiscountForItem($item)
    {
        if ($item->discount) {
            return $item->discount;
        } elseif ($item->subCategory && $item->subCategory->discount) {
            return $item->subCategory->discount;
        } elseif ($item->category && $item->category->discount) {
            return $item->category->discount;
        }
    }
}
