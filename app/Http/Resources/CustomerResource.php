<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'role' => $this->role,
            'address' => AddressResource::make($this->address),
            'image' => $this->media?->file,
            'created_by' => $this->user->name,
            'created_at' => dateFormat($this->created_at)
        ];
    }
}
