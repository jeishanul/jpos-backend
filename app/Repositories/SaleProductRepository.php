<?php

namespace App\Repositories;

use App\Http\Requests\SaleRequest;
use App\Models\SaleProduct;

class SaleProductRepository extends Repository
{
    public static function model()
    {
        return SaleProduct::class;
    }
    public static function storeByRequest($saleId, $productId, $productQty): SaleProduct
    {
        return self::create([
            'sale_id' => $saleId,
            'product_id' => $productId,
            'qty' => $productQty
        ]);
    }
}
