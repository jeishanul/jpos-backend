<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductRepository extends Repository
{
    private static $path = '/product';
    /**
     * A description of the entire PHP function.
     *
     * @return Product::class
     */
    public static function model()
    {
        return Product::class;
    }
    /**
     * Store a product using the given request.
     *
     * @param ProductRequest $productRequest The product request data
     * @return Product The created product
     */
    public static function storeByRequest(ProductRequest $productRequest): Product
    {
        $mediaId = null;
        if ($productRequest->hasFile('image')) {
            $media = MediaRepository::storeByRequest(
                $productRequest->image,
                self::$path,
                'Image',
            );
            $mediaId = $media->id;
        }

        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'name' => $productRequest->name,
            'code' => $productRequest->code,
            'type' => $productRequest->type,
            'model' => $productRequest->model,
            'barcode_symbology' => $productRequest->barcode_symbology,
            'category_id' => $productRequest->category_id,
            'tax_id' => $productRequest->tax_id,
            'tax_method' => $productRequest->tax_method,
            'brand_id' => $productRequest->brand_id,
            'unit_id' => $productRequest->unit_id,
            'media_id' => $mediaId,
            'price' => $productRequest->price,
            'cost' => $productRequest->cost,
            'qty' => 0,
            'alert_quantity' => $productRequest->alert_quantity,
            'status' => $productRequest->status
        ]);
    }
    /**
     * Update a product using the provided product request and product.
     *
     * @param ProductRequest $productRequest The product request data
     * @param Product $product The product to be updated
     * @return Product The updated product
     */
    public static function updateByRequest(ProductRequest $productRequest, Product $product): Product
    {
        $mediaId = null;
        if ($productRequest->hasFile('image')) {
            $media = MediaRepository::updateOrCreateByRequest(
                $productRequest->image,
                self::$path,
                'Image',
                $productRequest->media
            );
            $mediaId = $media->id;
        }

        self::update($product, [
            'name' => $productRequest->name,
            'code' => $productRequest->code,
            'type' => $productRequest->type,
            'model' => $productRequest->model,
            'barcode_symbology' => $productRequest->barcode_symbology,
            'category_id' => $productRequest->category_id,
            'tax_id' => $productRequest->tax_id,
            'tax_method' => $productRequest->tax_method,
            'brand_id' => $productRequest->brand_id,
            'unit_id' => $productRequest->unit_id,
            'media_id' => $mediaId ? $mediaId : $product->media_id,
            'price' => $productRequest->price,
            'cost' => $productRequest->cost,
            'alert_quantity' => $productRequest->alert_quantity,
            'status' => $productRequest->status
        ]);

        return $product;
    }
    /**
     * search function to search for products by name or code.
     *
     * @param string $search the keyword to search for
     * @return array the array of products matching the search
     */
    public static function search($search)
    {
        $products = self::shop()->products()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('code', 'Like', "%{$search}%");
        });

        return $products;
    }
}
