<?php

namespace App\Repositories;

use App\Models\Inventory;

class InventoryRepository
{
    public function __construct(
        private Inventory $inventory
    ){}

    public function getAllInventories(?int $pagination = 10) {
        $inventories = $this->inventory->with('product')->latest()->paginate($pagination);

        return $inventories;
    }

    public function getInventoryById(string $id) : Inventory {
        $inventory = $this->inventory->with('product')->findOrFail($id);

        return $inventory;
    }

    public function insertNewInventory(array $request) {
        $inventory = $this->inventory->create($request);

        return $inventory;
    }

    public function updateInventoryById(array $request, string $id) {
        $inventory = $this->inventory->findOrFail($id);
        $inventory->update($request);

        return $inventory;
    }

    public function deleteInventoryById(string $id) {
        $inventory = $this->inventory->findOrFail($id);
        $inventory->delete();

        return $inventory;
    }
}
