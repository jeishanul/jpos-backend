<?php

namespace App\Repositories;

use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;

class PurchaseRepository extends Repository
{
    public static $path = "/purchase";
    public static function model()
    {
        return Purchase::class;
    }
    public static function storeByRequest(PurchaseRequest $purchaseRequest): Purchase
    {
        return self::create([]);
    }
    public static function updateByRequest(PurchaseRequest $purchaseRequest, Purchase $purchase): Purchase
    {
        self::update($purchase, []);
        return $purchase;
    }
}
