<?php

namespace App\Http\Controllers;

use App\Models\CheckOut;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function create($slug)
    {
        $quantity = 1;
        if (isset($_GET['quantity'])) {
            $quantity = $_GET['quantity'];
            $quantity++;
        }
        $product = Product::where('slug', $slug)->first();

        if ($product->user_id == Auth::id()) {
            return redirect()->back()->with('message', 'You Can\'t Ship To Yourself');
        }
        return view('checkOut.checkOut', [
            'product' => $product,
            'quantity' => $quantity
        ]);
    }
    public function store(Request $request, $productId)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'address_line_1' => 'required',
            'address_line_2' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip_code' => 'required|numeric',
        ]);
        // dd($productId);
        CheckOut::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'mobile_number' => $request->mobile_number,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'product_id' => $productId,
            'user_id' => Auth::id()
        ]);
        return redirect()->route('home');
    }
}
