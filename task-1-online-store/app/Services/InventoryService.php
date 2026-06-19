<?php

namespace App\Services;

use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use Illuminate\Support\Facades\DB;

class InventoryService
{
    public function __construct(
        private InventoryRepository $inventoryRepository
    ){}

    public function getAllInventories(?int $pagination) {
        $inventories = $this->inventoryRepository->getAllInventories($pagination);

        return $inventories;
    }

    public function getInventoryById(string $id) : Inventory {
        $inventory = $this->inventoryRepository->getInventoryById($id);

        return $inventory;
    }

    public function insertNewInventory(array $request) {
        return DB::transaction(function () use ($request){
            $inventory = $this->inventoryRepository->insertNewInventory($request);

            return $inventory;
        });
    }

    public function updateInventoryById(array $request, string $id) {
        return DB::transaction(function () use ($request, $id) {
            $inventory = $this->inventoryRepository->updateInventoryById($request, $id);

            return $inventory;
        });
    }

    public function deleteInventoryById(string $id) {
        $inventory = $this->inventoryRepository->deleteInventoryById($id);

        return $inventory;
    }
}
