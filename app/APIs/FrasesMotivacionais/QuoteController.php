<?php

namespace App\APIs\FrasesMotivacionais;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function show() {
        
        $quotes = Quote::paginate(3);
        
        return QuoteResource::collection($quotes);
        
    }

    // create crud
    public function create(Request $request) {

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

    public function update(Request $request, $id) {
        $quote = Quote::find($id);
        $quote->quote = $request->quote;
        $quote->autor = $request->autor;
        $quote->save();
        return response()->json($quote);
    }

    public function delete($id) {
        $quote = Quote::find($id);
        $quote->delete();
        return response()->json(['message' => 'Quote deleted']);
    }

    public function showOne($id) {
        $quote = Quote::find($id);
        return response()->json($quote);
    }
}
