<?php

namespace App\Models\SenatorExpenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $connection = 'senator_expenses';

    protected $guarded = ['id'];

    protected $casts = [
        'id' => 'string',
    ];
}
