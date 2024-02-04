<?php

namespace App\Repositories;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;

class CurrencyRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return Currency::class
     */
    public static function model()
    {
        return Currency::class;
    }
    /**
     * Store a new currency record by request.
     *
     * @param CurrencyRequest $currencyRequest The currency request object
     * @return Currency The newly created currency record
     */
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
    /**
     * Update currency by request.
     *
     * @param CurrencyRequest $currencyRequest The currency request object
     * @param Currency $currency The currency object to update
     * @return Currency The updated currency object
     */
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
    /**
     * Search for currencies based on the given search term.
     *
     * @param mixed $search The search term to filter currencies by name.
     * @return Collection The collection of currencies matching the search term.
     */
    public static function search($search)
    {
        $currencies = self::shop()->currencies()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%");
        });

        return $currencies;
    }
}
