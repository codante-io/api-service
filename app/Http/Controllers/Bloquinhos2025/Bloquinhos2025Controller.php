<?php

namespace App\Http\Controllers\Bloquinhos2025;

use App\Http\Controllers\Controller;
use App\Http\Resources\Bloquinhos2025\Bloquinhos2025Resource;
use App\Models\Bloquinhos2025\Agenda;
use Illuminate\Http\Request;

class Bloquinhos2025Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Agenda::query();

        $request->validate([
            'date' => 'date',
            'search' => 'string',
            'city' => 'string',
            'sort' => 'in:asc,desc',
        ]);

        if (request()->has('date')) {
            $query->whereDate('date_time', request()->input('date'));
        }   

        if (request()->has('city')) {
            $query->where('city', request()->input('city'));
        }   

        if (request()->has('sort')) {
            $query->orderBy('date_time', request()->input('sort'));
        } else {
            $query->orderBy('date_time', 'asc');
        }

        if (request()->has('search')) {
            $query->where('title', 'like', "%".request()->input('search')."%");
        }   


        return Bloquinhos2025Resource::collection($query->paginate(10));
    }
}
