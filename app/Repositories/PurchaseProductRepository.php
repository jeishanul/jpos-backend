<?php

namespace App\Repositories;

use App\Http\Requests\PurchaseRequest;
use App\Models\PurchaseProduct;

class PurchaseProductRepository extends Repository
{
    public static function model()
    {
        return PurchaseProduct::class;
    }
    public static function storeByRequest($purchaseId, $productId, $productQty): PurchaseProduct
    {
        return self::create([
            'purchase_id' => $purchaseId,
            'product_id' => $productId,
            'qty' => $productQty
        ]);
    }
}
