<?php

namespace App\Services;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Collection;

class MenuService
{
    public function getAllMenus(): Collection|array
    {
        return Menu::query()
            ->with('items')
            ->get();
    }
}
