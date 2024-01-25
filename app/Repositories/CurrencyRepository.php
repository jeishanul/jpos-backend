<?php

namespace App\Repositories;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyRepository extends Repository
{
    public static function model()
    {
        return Currency::class;
    }
    public static function storeByRequest(CurrencyRequest $currencyRequest): Currency
    {
        return self::create([]);
    }
    public static function updateByRequest(CurrencyRequest $currencyRequest, Currency $currency): Currency
    {
        self::update($currency, []);

        return $currency;
    }
}
