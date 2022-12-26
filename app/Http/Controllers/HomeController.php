<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $categories = Category::latest()->paginate(5);

        $trandyProducts = DB::select('SELECT * FROM products WHERE views >= 1');
        $justArrived = Product::latest()->paginate(7);

        return view('home', [
            'categories' => $categories,
            'trandyProducts' => $trandyProducts,
            'justArrived' => $justArrived
        ]);
    }
}
