<?php

namespace App\Repositories;

use App\Models\Purchase;

class PurchaseRepository extends Repository
{
    public static $path = "/purchase";
    public static function model()
    {
        return Purchase::class;
    }
}
