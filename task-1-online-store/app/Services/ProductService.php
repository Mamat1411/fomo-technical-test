<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository
    ){}

    public function getAllProducts(?int $pagination) {
        $products = $this->productRepository->getAllProducts($pagination);

        return $products;
    }

    public function getProductById(string $id) : Product {
        $product = $this->productRepository->getProductById($id);

        return $product;
    }

    public function insertNewProduct(array $request) {
        $product = $this->productRepository->insertNewProduct($request);

        return $product;
    }

    public function updateProductById(array $request, string $id) {
        $product = $this->productRepository->updateProductById($request, $id);

        return $product;
    }

    public function deleteProductById(string $id) {
        $product = $this->productRepository->deleteProductById($id);

        return $product;
    }
}
