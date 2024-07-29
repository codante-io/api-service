<?php

namespace App\Models\OlympicGames;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $connection = 'olympic_games';

    public $incrementing = false;

    public $keyType = 'string';

    protected $guarded = ['id'];
}
