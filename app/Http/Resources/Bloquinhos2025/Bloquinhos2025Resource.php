<?php

namespace App\Http\Resources\Bloquinhos2025;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Bloquinhos2025Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
    