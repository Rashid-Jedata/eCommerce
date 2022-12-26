<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;



class ShopController extends Controller
{
    public function index()
    {
        $sortBy = 'created_at';
        if (isset($_GET['sortBy'])) {
            if ($_GET['sortBy'] == 'popularity')
                $sortBy = 'views';
            elseif ($_GET['sortBy'] == 'rating')
                $sortBy = 'rating';
        }
        $search = '';
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        }
        $category_id = '';
        if (isset($_GET['category'])) {
            $category_id = Category::where('name', $_GET['category'])->first()->id;
        }
        $products = DB::select("select * from products where name LIKE '%{$search}%' AND category_id LIKE '%{$category_id}%'  ORDER BY $sortBy");
        // $products = Product::orderBy($sortBy)->paginate(10);
        return view('Shop.index', compact('products'));
    }
}
