<?php

namespace App\Repositories;

use App\Http\Requests\PurchaseRequest;
use App\Models\PurchaseProduct;

class PurchaseProductRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return PurchaseProduct::class
     */
    public static function model()
    {
        return PurchaseProduct::class;
    }
    /**
     * storeByRequest function stores a new purchase product by request.
     *
     * @param datatype $purchaseId description
     * @param datatype $productId description
     * @param datatype $productQty description
     * @return PurchaseProduct
     */
    public static function storeByRequest($purchaseId, $productId, $productQty): PurchaseProduct
    {
        return self::create([
            'purchase_id' => $purchaseId,
            'product_id' => $productId,
            'qty' => $productQty
        ]);
    }
}
