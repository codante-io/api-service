<?php

namespace App\Models\JobBoard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $connection = 'job_board';

    protected $guarded = ['id'];
}
