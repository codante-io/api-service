<?php

namespace App\Models\OlympicGames;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'olympic_games';

    protected $guarded = ['id'];

    public function competitors()
    {
        return $this->hasMany(Competitor::class)->with('country');
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id', 'id');
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
}
