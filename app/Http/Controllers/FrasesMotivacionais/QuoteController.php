<?php

namespace App\Http\Controllers\FrasesMotivacionais;

use App\Http\Controllers\Controller;
use App\Http\Resources\FrasesMotivacionais\QuoteResource;
use App\Models\FrasesMotivacionais\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class QuoteController extends Controller
{
    public function show()
    {

        $quotes = Quote::all();

        return QuoteResource::collection($quotes);
    }

    // create crud
    public function create(Request $request)
    {

        // validate with maxlength
        $request->validate([
            'quote' => 'required|max:1000',
            'author' => 'required|max:255'
        ]);


        $quote = new Quote();
        $quote->quote = $request->quote;
        $quote->author = $request->author;
        $quote->save();
        return response()->json($quote);
    }

    public function update(Request $request, $id)
    {
        $quote = Quote::find($id);
        $quote->quote = $request->quote;
        $quote->autor = $request->autor;
        $quote->save();
        return response()->json($quote);
    }

    public function delete($id)
    {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json(['message' => 'Quote deleted']);
    }

    public function showOne($id)
    {
        $quote = Quote::find($id);
        return new QuoteResource($quote);
    }

    public function reset()
    {
        Artisan::call('api:frases-motivacionais:reset');
        return response()->json(['message' => 'Database reset']);
    }
}
