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
        $request = request();
        $search = $request->search;
        $page = $request->page;
        $take = $request->take;
        $skip = ($page * $take) - $take;

        $searchProducts = ProductRepository::search($search);
        $total = $searchProducts->count();
        $products = $searchProducts->when($page && $take, function ($query) use ($skip, $take) {
            $query->skip($skip)->take($take);
        })->get();

        return $this->json('Product List', [
            'total' => $total,
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
