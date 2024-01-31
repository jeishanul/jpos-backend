<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'model' => $this->model,
            'barcode_symbology' => $this->barcode_symbology,
            'category' => [
                'id' => $this->category->id,
                'name' => $this->category->name
            ],
            'tax' => [
                'name' => $this->tax?->name,
                'rate' => $this->tax?->rate,
            ],
            'tax_method' => $this->tax_method,
            'brand' => [
                'id' => $this->brand->id,
                'name' => $this->brand->name
            ],
            'unit' => [
                'id' => $this->unit->id,
                'name' => $this->unit->name,
                'code' => $this->unit->code
            ],
            'media' => $this->media->file,
            'price' => numberFormat($this->price),
            'cost' => numberFormat($this->cost),
            'qty' => $this->qty,
            'alert_quantity' => $this->alert_quantity,
            'status' => $this->status,
            'created_by' => $this->user->name
        ];
    }
}
