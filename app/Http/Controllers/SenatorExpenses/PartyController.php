<?php

namespace App\Http\Controllers\SenatorExpenses;

use App\Http\Controllers\Controller;
use App\Http\Resources\SenatorExpenses\PartyResource;
use App\Models\SenatorExpenses\Party;

class PartyController extends Controller
{
    public function index()
    {
        $parties = Party::all();

        return new PartyResource($parties);
    }
}
