<?php

namespace App\Repositories;

use App\Models\PurchaseProduct;

class PurchaseProductRepository extends Repository
{
    public function model()
    {
        return PurchaseProduct::class;
    }
}
