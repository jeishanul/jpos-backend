<?php

namespace App\Repositories;

use App\Models\Purchase;

class PurchaseRepository extends Repository
{
    public function model()
    {
        return Purchase::class;
    }
}
