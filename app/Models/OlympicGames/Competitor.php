<?php

namespace App\Models\OlympicGames;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    protected $connection = 'olympic_games';

    protected $guarded = ['id'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
