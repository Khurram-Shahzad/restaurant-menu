<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function getAllItems()
    {
        return Item::query()
            ->with('category', 'subCategory')
            ->get();
    }
}
