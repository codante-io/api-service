<?php

namespace App\Http\Resources\SenatorExpenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SenatorShortResource extends JsonResource
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
            'party' => $this->party,
            'UF' => $this->UF,
            'is_active' => $this->is_active,
        ];
    }
}
