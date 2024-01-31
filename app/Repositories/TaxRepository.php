<?php

namespace App\Repositories;

use App\Http\Requests\TaxRequest;
use App\Models\Tax;

class TaxRepository extends Repository
{
    public static function model()
    {
        return Tax::class;
    }
    public static function storeByRequest(TaxRequest $taxRequest): Tax
    {
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'name' => $taxRequest->name,
            'rate' => $taxRequest->rate,
            'status' => $taxRequest->status
        ]);
    }
    public static function updateByRequest(TaxRequest $taxRequest, Tax $tax): Tax
    {
        self::update($tax, [
            'name' => $taxRequest->name,
            'rate' => $taxRequest->rate,
            'status' => $taxRequest->status
        ]);

        return $tax;
    }
}
