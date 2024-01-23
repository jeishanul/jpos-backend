<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ProductRepository::getAll();
        return $this->json('Product List', [
            'products' => ProductResource::collection($products),
        ]);
    }
    public function store(ProductRequest $productRequest)
    {
        $product = ProductRepository::storeByRequest($productRequest);
        return $this->json('Product successfully created', [
            'product' => ProductResource::make($product),
        ]);
    }
    public function details(Product $product)
    {
        return $this->json('Product Details', [
            'product' => ProductResource::make($product),
        ]);
    }
    public function update(ProductRequest $productRequest, Product $product)
    {
        $product = ProductRepository::updateByRequest($productRequest, $product);
        return $this->json('Product successfully updated', [
            'product' => ProductResource::make($product),
        ]);
    }
    public function delete(Product $product)
    {
        $product->delete();
        return $this->json('Product successfully deleted');
    }
}
