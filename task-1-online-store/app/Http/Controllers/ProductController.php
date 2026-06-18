<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pagination = $request['pagination'];
        try {
            $products = $this->productService->getAllProducts($pagination);
            $data = ProductResource::collection($products);

            return response()->json([
                "status" => 200,
                "message" => "Successfully Get All Products",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Get All Products Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $response = DB::transaction(function () use ($validatedData) {
                $product = $this->productService->insertNewProduct($validatedData);
                $data = new ProductResource($product);

                return $data;
            });

            return response()->json([
                "status" => 201,
                "message" => "New Product Added",
                "data" => $response
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Insert New Product Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        try {
            $product = $this->productService->getProductById($product->id);
            $data = new ProductResource($product);

            return response()->json([
                "status" => 200,
                "message" => "Successfully Get Product By ID",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Get Product By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();
        $productId = $product->id;

        try {
            $response = DB::transaction(function () use ($validatedData, $productId) {
                $product = $this->productService->updateProductById($validatedData, $productId);
                $data = new ProductResource($product);

                return $data;
            });

            return response()->json([
            "status" => 200,
            "message" => "Successfully Update Product By ID",
            "data" => $response
        ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Update Product By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product = $this->productService->deleteProductById($product->id);
            $data = new ProductResource($product);

            return response()->json([
                "status" => 200,
                "message" => "Successfully Delete Product By ID",
                "data" => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 500,
                "message" => "Delete Product By ID Failed",
                "error" => $e->getMessage()
            ], 500);
        }
    }
}
