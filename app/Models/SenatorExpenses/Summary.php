<?php

namespace App\Models\SenatorExpenses;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $connection = 'senator_expenses';

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'summary' => 'array',
        ];
    }
}
