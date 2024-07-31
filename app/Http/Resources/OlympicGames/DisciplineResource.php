<?php

namespace App\Http\Resources\OlympicGames;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class DisciplineResource extends JsonResource
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
            'pictogram_url' => $this->pictogram_url,
            'pictogram_url_dark' => Str::replace('.avif', '-dark.avif', $this->pictogram_url),
        ];
    }
}
