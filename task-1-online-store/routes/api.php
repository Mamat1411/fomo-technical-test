<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/up', function () {
    return response()->json([
        "status" => 200,
        "message" => "Application is healthy"
    ]);
});

Route::group([
    'prefix' => '/auth'
], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::post('/products', [ProductController::class, 'index']);
Route::post('/inventories', [InventoryController::class, 'index']);
Route::get('/product/{product}', [ProductController::class, 'show']);
Route::get('/inventory/{inventory}', [InventoryController::class, 'show']);

Route::group([
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/product', ProductController::class)->only(['store', 'update', 'destroy']);

    Route::apiResource('/inventory', InventoryController::class)->only(['store', 'update', 'destroy']);
});

