<?php

namespace App\Http\Resources\SenatorExpenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function __construct($resource, private $meta = [])
    {
        parent::__construct($resource);
        $this->meta = $meta;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'original_id' => $this->original_id,
            'date' => $this->date,
            'amount' => number_format($this->amount, 2, '.', ''),
            'expense_category' => $this->expense_category,
            'description' => $this->description,
            'supplier' => $this->supplier,
            'supplier_document' => $this->supplier_document,
            'senator' => $this->whenLoaded('senator', new SenatorShortResource($this->senator)),
        ];
    }

    public function with(Request $request): array
    {
        return $this->meta;
    }
}
