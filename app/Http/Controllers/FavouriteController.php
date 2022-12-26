<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FavouriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $favourites = Favourite::where('user_id', Auth::id())->get();

        $in = '';
        for ($i = 0; $i < count($favourites); $i++) {
            $in .=  $favourites[$i]->product_id;
            if ($i < count($favourites) - 1) {
                $in .= ',';
            }
        }

        if ($in == null) return redirect()->back();
        $products = DB::select("SELECT * FROM products WHERE id IN({$in})");
        return view('Shop.index', [
            // 'products' =>  $favourites->products
            'products' =>  $products,
            'favourite' => true
        ]);
    }


    public function store(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if ($product == null) return redirect()->back();

        $alreadyExists = Favourite::where('product_id', $product->id)->where('user_id', Auth::id())->first();
        if ($alreadyExists != null) return redirect()->back();


        Favourite::create([
            'product_id' => $product->id,
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->where('user_id', Auth::id())->first();
        $favourite = Favourite::where('product_id', $product->id)->where('user_id', Auth::id())->first();

        $favourite->delete();

        return redirect()->back();
    }
}
