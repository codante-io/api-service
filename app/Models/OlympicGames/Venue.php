<?php

namespace App\Models\OlympicGames;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use HasFactory;

    protected $connection = 'olympic_games';

    protected $guarded = ['id'];

    public $incrementing = false;

    public $keyType = 'string';

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
