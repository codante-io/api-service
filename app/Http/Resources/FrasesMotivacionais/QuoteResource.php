<?php

namespace App\Http\Resources\FrasesMotivacionais;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'quote' => $this->quote,
            'author' => $this->author
        ];
    }
}
