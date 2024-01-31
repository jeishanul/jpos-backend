<?php

namespace App\Repositories;

use App\Enums\PaymentStatus;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;
use Carbon\Carbon;

class SaleRepository extends Repository
{
    /**
     * A description of the entire PHP function.
     *
     * @return Sale::class
     */
    public static function model()
    {
        return Sale::class;
    }
    /**
     * Store sale by request.
     *
     * @param SaleRequest $saleRequest description
     * @throws Some_Exception_Class description of exception
     * @return Sale
     */
    public static function storeByRequest(SaleRequest $saleRequest): Sale
    {
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'customer_id' => $saleRequest->customer_id,
            'date' => Carbon::parse($saleRequest->date) ?? now(),
            'reference_no' => 'ps-' . date("Ymd") . '-' . date("his"),
            'order_discount' => $saleRequest->order_discount,
            'shipping_cost' => $saleRequest->shipping_cost,
            'grand_total' => 0,
            'paid_amount' => $saleRequest->paid_amount,
            'payment_status' => PaymentStatus::UNPAID->value,
            'payment_method' => $saleRequest->payment_method,
            'note' => $saleRequest->note,
        ]);
    }
    /**
     * Update a sale using the provided request data.
     *
     * @param SaleRequest $saleRequest The sale request data
     * @param Sale $sale The sale to be updated
     * @return Sale The updated sale
     */
    public static function updateByRequest(SaleRequest $saleRequest, Sale $sale): Sale
    {
        self::update($sale, [
            'customer_id' => $saleRequest->customer_id,
            'date' => Carbon::parse($saleRequest->date) ?? now(),
            'reference_no' => 'pr-' . date("Ymd") . '-' . date("his"),
            'order_discount' => $saleRequest->order_discount,
            'shipping_cost' => $saleRequest->shipping_cost,
            'grand_total' => 0,
            'paid_amount' => $saleRequest->paid_amount,
            'payment_status' => PaymentStatus::UNPAID->value,
            'payment_method' => $saleRequest->payment_method,
            'note' => $saleRequest->note,
        ]);

        return $sale;
    }
    /**
     * Perform a search for sales based on the given search parameter.
     *
     * @param mixed $search The search parameter to filter sales by reference number.
     * @return Collection The collection of sales matching the search parameter.
     */
    public static function search($search)
    {
        $sales = self::shop()->sales()->when($search, function ($query) use ($search) {
            $query->where('reference_no', 'Like', "%{$search}%");
        });

        return $sales;
    }
}
