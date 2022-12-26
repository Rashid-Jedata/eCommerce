<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string',
            'personalRating' => 'required|numeric'
        ]);

        Reviews::create([
            'comment' => $request->comment,
            'personalRating' => $request->personalRating,
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);

        $product = Product::find($id);
        $personalRating = Reviews::where('product_id', $product->id)->get('personalRating');

        $avg = 0;
        foreach ($personalRating as $rating) {
            $avg += $rating->personalRating;
        }
        $avg /= $personalRating->count();

        $avg = round($avg, 1);

        $comma = $avg - ((int)$avg);
        $comma = round($comma);

        $avg =  ((int)$avg);
        if ($comma == 1) {
            $avg += .5;
        }
        $product->rating = $avg;
        $product->save();


        return redirect()->back();
    }
}
