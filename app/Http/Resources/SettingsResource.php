<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'system_name' => $this->system_name,
            'logo' => $this->logo?->file,
            'small_logo' => $this->smallLogo?->file,
            'favicon' => $this->favicon?->file,
            'currency' => CurrencyResource::make($this->currency),
            'currency_position' => $this->currency_position,
            'date_format' => $this->date_format,
            'date_separator' => $this->date_separator,
            'timezone' => $this->timezone,
            'developed_by' => $this->developed_by,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'address' => $this->address
        ];
    }
}
