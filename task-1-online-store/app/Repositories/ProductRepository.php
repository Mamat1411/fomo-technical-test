<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function __construct(
        private Product $product
    ){}

    public function getAllProducts(int $pagination = 10) {
        $products = $this->product->latest()->paginate($pagination);
        return $products;
    }

    public function getProductById(string $id) : Product {
        $product = $this->product->findOrFail($id);

        return $product;
    }

    public function insertNewProduct(array $request) {
        $product = $this->product->create($request);

        return $product;
    }

    public function updateProductById(array $request, string $id) {
        $product = $this->product->findOrFail($id);
        $product->update($request);

        return $product;
    }

    public function deleteProductById(string $id) {
        $product = $this->product->findOrFail($id);
        $product->delete();

        return $product;
    }
}
