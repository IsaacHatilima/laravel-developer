<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GolferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'debitor_account' => $this->debitor_account,
            'name' => $this->name,
            'email' => $this->email,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'born_at' => $this->born_at->toDateString(),
            'distance_km' => round($this->distance, 2).' km',  // Calculated distance from raw SQL
        ];
    }
}
