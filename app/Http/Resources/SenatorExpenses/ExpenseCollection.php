<?php

namespace App\Http\Resources\SenatorExpenses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpenseCollection extends ResourceCollection
{
    public function __construct($resource, private $meta = [])
    {
        parent::__construct($resource);
        $this->meta = $meta;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function with($request): array
    {
        return $this->meta;
    }
}
