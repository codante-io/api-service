<?php

namespace App\Models\Bloquinhos2025;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $connection = 'bloquinhos2025';

    protected $guarded = ['id'];

    protected $table = 'agenda';

    protected $casts = [
        'date_time' => 'datetime',
    ];
}
