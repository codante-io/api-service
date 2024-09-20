<?php

namespace App\Http\Controllers\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reviews\Review;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Support\Facades\Artisan;

class ReviewController extends Controller
{
    public function show()
    {

        $reviews = Review::all();

        return ReviewResource::collection($reviews);
    }

    // create crud
    public function create(Request $request)
    {

        // validate with maxlength
        $request->validate([
            'name' => 'required|max:1000',
            'description' => 'required|max:255',
            'stars' => 'required|integer|between:1,5',
        ]);

        $review = new Review();
        $review->name = $request->name;
        $review->description = $request->description;
        $review->stars = $request->stars;
        $review->save();

        return response()->json($review);
    }

    public function update(Request $request, $id)
    {
        $review = Review::find($id);
        $review->name = $request->name;
        $review->description = $request->description;
        $review->stars = $request->stars;
        $review->save();

        return response()->json($review);
    }

    public function delete($id)
    {
        $review = Review::find($id);
        $review->delete();

        return response()->json(['message' => 'Review deleted']);
    }

    public function showOne($id)
    {
        $review = Review::findOrFail($id)->json();

        return new ReviewResource($review);
    }

    public function reset()
    {
        Artisan::call('api:reviews:reset');

        return response()->json(['message' => 'Database reset']);
    }
}
