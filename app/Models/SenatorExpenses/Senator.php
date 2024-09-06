<?php

namespace App\Models\SenatorExpenses;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Senator extends Model
{
    use HasFactory;

    protected $connection = 'senator_expenses';

    protected $guarded = ['id'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
