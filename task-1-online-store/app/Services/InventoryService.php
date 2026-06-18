<?php

namespace App\Services;

use App\Repositories\InventoryRepository;

class InventoryService
{
    public function __construct(
        private InventoryRepository $inventoryRepository
    ){}
}
