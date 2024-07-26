<?php

namespace App\Http\Resources\OlympicGames;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'continent' => $this->continent,
            'flag_url' => $this->flag_url,
        ];
    }
}
