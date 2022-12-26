<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{


    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', [
            'products' => $products
        ]);
    }



    public function create()
    {
        return view('products.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'details' => 'required',
            'category_id' => 'required',
            'images' => 'array'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'slug' => Str::slug($request->name),
            'views' => 0,
            'rating' => 0,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
            'mainImage' =>  $this->savePhoto($request->images[0], Auth::id())

        ]);

        if ($request->has('images'))
            for ($i = 1; $i < count($request->images); $i++) {
                $url = $this->savePhoto($request->images[$i], $product->id);
                $imageId = Image::create([
                    'url' => $url
                ]);
                $product->images()->attach([
                    'image_id' => $imageId->id
                ]);
            }

        return redirect()->route('products.index');
    }

    public static function savePhoto($image, $id = 0)
    {
        $newImage =  time() . $id . $image->getClientOriginalName();
        move_uploaded_file($image, 'uploads/products/' . $newImage);
        return 'uploads/products/' . $newImage;
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (Auth::user() != null) {
            $view = View::where('user_id', Auth::id())->where('product_id', $product->id)->first();
            if ($view == null) {
                View::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id
                ]);

                $view = View::where('product_id', $product->id)->get();
                $product->views = $view->count();
                $product->save();
            }
        }


        $reviewsCount = $product->reviews->count();


        return view('products.show', [
            'product' => $product,
            'reviewsCount' => $reviewsCount
        ]);
    }



    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->where('user_id', Auth::id())->first();
        return view('products.edit', compact('product'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'details' => 'required',
            'category_id' => 'required',
            'images' => 'array'
        ]);

        $product = Product::find($id);


        $product->name = $request->name;
        $product->price  = $request->price;
        $product->details = $request->details;
        $product->category_id = $request->category_id;


        if ($request->has('images')) {
            $this->deleteImages($product->images, $product->mainImage);

            $product->mainImage =  $this->savePhoto($request->images[0], $product->id);

            for ($i = 1; $i < count($request->images); $i++) {
                $url = $this->savePhoto($request->images[$i], $product->id);
                $imageId = Image::create([
                    'url' => $url
                ]);
                $product->images()->attach([
                    'image_id' => $imageId->id
                ]);
            }
        }

        $product->save();

        return redirect()->route('products.index');
    }

    public function deleteImages($images, $mainImage)
    {
        foreach ($images as $image) {
            File::delete($image->url);
            File::delete($mainImage);
            Image::find($image->id)->delete();
        }
    }

    public function softDelete($id)
    {
        $product = Product::find($id)->where('user_id', Auth::id())->first();
        $this->deleteImages($product->images, $product->mainImage);
        $product->delete();
        return redirect()->route('products.index');
    }

    // public function HardDelete($id)
    // {
    //     $product =  Product::withTrashed()->where('id', $id)->forceDelete();
    //     foreach ($product->images as $image) {
    //         File::delete($image);
    //         Image::find($image->id)->delete();
    //     }

    //     $product->delete();
    //     return redirect()->route('products.index');
    // }
}
