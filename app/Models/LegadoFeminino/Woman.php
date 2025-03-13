<?php

namespace App\Models\LegadoFeminino;

use Illuminate\Database\Eloquent\Model;

class Woman extends Model
{
    protected $table = 'women'; 
    protected $fillable = ['id', 'nome', 'ano_nascimento', 'ano_morte', 'contribuicao', 'foto']; 
}
