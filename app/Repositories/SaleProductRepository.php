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
    /**
     * A description of the entire PHP function.
     *
     * @param datatype $saleId description
     * @param datatype $productId description
     * @param datatype $productQty description
     * @throws Some_Exception_Class description of exception
     * @return SaleProduct
     */
    public static function storeByRequest($saleId, $productId, $productQty): SaleProduct
    {
        return self::create([
            'sale_id' => $saleId,
            'product_id' => $productId,
            'qty' => $productQty
        ]);
    }
}
