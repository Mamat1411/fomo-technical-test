<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/up', function () {
    return response()->json([
        "status" => 200,
        "message" => "Application is healthy"
    ]);
});

Route::post('/products', [ProductController::class, 'index']);
Route::apiResource('/product', ProductController::class)->only(['show', 'store', 'update', 'destroy']);

Route::post('/inventories', [InventoryController::class, 'index']);
Route::apiResource('/inventory', InventoryController::class)->only(['show', 'store', 'update', 'destroy']);
