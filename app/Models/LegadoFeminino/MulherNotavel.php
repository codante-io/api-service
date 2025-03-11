<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MulherNotavel extends Model
{
    protected $table = 'mulheres_notaveis'; 
    protected $fillable = ['nome', 'anoNascimento', 'anoMorte', 'contribuicao']; 
}
