<?php

namespace App\Repositories;

use App\Enums\PaymentStatus;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;

class PurchaseRepository extends Repository
{
    public static $path = "/purchase";
    public static function model()
    {
        return Purchase::class;
    }
    public static function storeByRequest(PurchaseRequest $purchaseRequest): Purchase
    {
        $mediaId = null;
        if ($purchaseRequest->hasFile('document')) {
            $media = MediaRepository::storeByRequest(
                $purchaseRequest->document,
                self::$path,
                'Image',
            );
            $mediaId = $media->id;
        }
        
        return self::create([
            'user_id' => auth()->id(),
            'shop_id' => self::shop()->id,
            'supplier_id' => $purchaseRequest->supplier_id,
            'media_id' => $mediaId,
            'date' => $purchaseRequest->date ?? now(),
            'reference_no' => 'pr-' . date("Ymd") . '-' . date("his"),
            'order_discount' => $purchaseRequest->order_discount,
            'shipping_cost' => $purchaseRequest->shipping_cost,
            'grand_total' => 0,
            'paid_amount' => $purchaseRequest->paid_amount,
            'status' => $purchaseRequest->status,
            'payment_status' => PaymentStatus::UNPAID->value,
            'payment_method' => $purchaseRequest->payment_method,
            'note' => $purchaseRequest->note,
        ]);
    }
    public static function updateByRequest(PurchaseRequest $purchaseRequest, Purchase $purchase): Purchase
    {
        self::update($purchase, []);
        return $purchase;
    }
}
