<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'parentCategory' => $this->parentCategory->name ?? 'N/A',
            'image' => $this->media->file,
            'status' => $this->status,
            'created_by' => $this->user->name,
            'created_at' => dateFormat($this->created_at)
        ];
    }
}
