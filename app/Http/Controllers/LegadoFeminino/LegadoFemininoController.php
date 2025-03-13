<?php

namespace App\Http\Controllers\LegadoFeminino;

use App\Http\Controllers\Controller;
use App\Http\Resources\LegadoFeminino\LegadoFemininoResource;
use App\Models\LegadoFeminino\Woman;
use Illuminate\Http\Request;

class LegadoFemininoController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $query = MulherNotavel::query();
        $women = Woman::all();

        return LegadoFemininoResource::collection($women);
    }
}
