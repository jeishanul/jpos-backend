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
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'name' => $currencyRequest->name,
            'symbol' => $currencyRequest->symbol,
            'code' => $currencyRequest->code,
            'status' => $currencyRequest->status
        ]);
    }
    public static function updateByRequest(CurrencyRequest $currencyRequest, Currency $currency): Currency
    {
        self::update($currency, [
            'name' => $currencyRequest->name,
            'symbol' => $currencyRequest->symbol,
            'code' => $currencyRequest->code,
            'status' => $currencyRequest->status
        ]);

        return $currency;
    }
    public static function search($search)
    {
        $currencies = self::shop()->currencies()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $currencies;
    }
}
