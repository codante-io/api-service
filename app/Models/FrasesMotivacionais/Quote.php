<?php

namespace App\Models\FrasesMotivacionais;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $connection = 'frases_motivacionais';
}
