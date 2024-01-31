<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'supplier' => [
                'id' => $this->supplier->id,
                'name' => $this->supplier->name,
            ],
            'media' => $this->media?->file,
            'date' => dateFormat($this->date),
            'reference_no' => $this->reference_no,
            'order_discount' => numberFormat($this->order_discount),
            'shipping_cost' => numberFormat($this->shipping_cost),
            'grand_total' => numberFormat($this->grand_total),
            'paid_amount' => numberFormat($this->paid_amount),
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'payment_method' => $this->payment_method,
            'note' => $this->note,
            'purchase_products' => PurchaseProductResource::collection($this->purchaseProducts),
            'created_by' => $this->user->name
        ];
    }
}
