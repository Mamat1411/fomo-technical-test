<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use App\Http\Requests\UpdateInventoryRequest;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function __construct(
        private InventoryService $inventoryService
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request['pagination'];
        try {
            $inventories = $this->inventoryService->getAllInventories($pagination);
            $data = InventoryResource::collection($inventories);

            return response()->json([
                "status" => 200,
                "message" => "Successfully Get All Inventories",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Get All Inventories Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventoryRequest $request)
    {
        $validatedData = $request->validated();
        try {
            $data = new InventoryResource($this->inventoryService->insertNewInventory($validatedData));

            return response()->json([
                "status" => 201,
                "message" => "Successfully Insert New Inventory",
                "data" => $data
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Insert New Inventory Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        try {
            $data = new InventoryResource($this->inventoryService->getInventoryById($inventory->id));

            return response()->json([
                "status" => 200,
                "message" => "Successfully Get Inventory By ID",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Get Inventory By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventoryRequest $request, Inventory $inventory)
    {
        $validatedData = $request->validated();

        try {
            $data = new InventoryResource($this->inventoryService->updateInventoryById($validatedData, $inventory->id));

            return response()->json([
                "status" => 200,
                "message" => "Successfully Update Inventory By ID",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Update Inventory By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        try {
            $data = new InventoryResource($this->inventoryService->deleteInventoryById($inventory->id));

            return response()->json([
                "status" => 200,
                "message" => "Successfully Delete Inventory By ID",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Delete Inventory By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
