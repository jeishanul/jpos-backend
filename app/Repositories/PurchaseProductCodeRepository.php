<?php

namespace App\Repositories;

use App\Models\PurchaseProductCode;

class PurchaseProductCodeRepository extends Repository
{
    public function model()
    {
        return PurchaseProductCode::class;
    }
}
