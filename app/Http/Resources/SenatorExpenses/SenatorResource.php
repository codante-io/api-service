<?php

namespace App\Http\Resources\SenatorExpenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SenatorResource extends JsonResource
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
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'UF' => $this->UF,
            'avatar_url' => $this->avatar_url,
            'homepage' => $this->homepage,
            'email' => $this->email,
            'party' => $this->party,
            'is_titular' => $this->is_titular,
            'is_active' => $this->is_active,
            // 'expenses' => $this->whenLoaded(ExpenseResource::collection($this->expenses)),
        ];
    }
}
