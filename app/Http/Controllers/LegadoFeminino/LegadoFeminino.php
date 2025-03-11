<?php

namespace App\Http\Controllers\Legado;

use App\Http\Controllers\Controller;
use App\Http\Resources\LegadoFeminino\LegadoFemininoResource;
use App\Models\LegadoFeminino\Agenda;
use Illuminate\Http\Request;

class LegadoFemininoController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MulherNotavel::query();

        $request->validate([
            'anoNascimento' => 'string',
            'search' => 'string',
            'sort' => 'in:asc,desc',
        ]);

        if (request()->has('anoNascimento')) {
            $query->where('anoNascimento', request()->input('anoNascimento'));
        }   

        if (request()->has('sort')) {
            $query->orderBy('anoNascimento', request()->input('sort'));
        } else {
            $query->orderBy('nome', 'asc');
        }

        if (request()->has('search')) {
            $query->where('nome', 'like', "%".request()->input('search')."%");
        }   

        return LegadoFemininoResource::collection($query->paginate(10));
    }
}
