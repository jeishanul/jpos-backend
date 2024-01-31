<?php

namespace App\Repositories;

use App\Http\Requests\TaxRequest;
use App\Models\Tax;

class TaxRepository extends Repository
{
    /**
     * Store a new tax record based on the given TaxRequest.
     *
     * @param TaxRequest $taxRequest The tax request data
     * @return Tax The newly created tax record
     */
    public static function model()
    {
        return Tax::class;
    }
    /**
     * Store a new tax record based on the given TaxRequest.
     *
     * @param TaxRequest $taxRequest The tax request data
     * @return Tax The newly created tax record
     */
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
    /**
     * Update a Tax entity based on a TaxRequest object.
     *
     * @param TaxRequest $taxRequest The tax request object
     * @param Tax $tax The tax entity to be updated
     * @return Tax The updated tax entity
     */
    public static function updateByRequest(TaxRequest $taxRequest, Tax $tax): Tax
    {
        self::update($tax, [
            'name' => $taxRequest->name,
            'rate' => $taxRequest->rate,
            'status' => $taxRequest->status
        ]);

        return $tax;
    }
    /**
     * Search for taxs based on the given search parameter.
     *
     * @param mixed $search The search parameter
     * @return mixed The resulting taxs
     */
    public static function search($search)
    {
        $taxs = self::shop()->taxs()->when($search, function ($query) use ($search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('rate', 'Like', "%{$search}%");
        });

        return $taxs;
    }
}
