<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository
{
    public function __construct(
        private Inventory $inventory
    ){}
}
