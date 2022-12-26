<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Http\Controllers\ProductController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // if (!Auth::user()->is_admin) {
        //     return redirect()->back();
        // }

    }

    public function preventUsers()
    {
        if (!Auth::user()->is_admin) {
            return redirect()->back();
        }
    }

    public function index()
    {
        $this->preventUsers();


        $categories = Category::paginate(5);
        return view('Category.index')->with('categories', $categories);
    }


    public function create()
    {
        $this->preventUsers();
        return view('Category.create');
    }



    public function store(Request $request)
    {
        $this->preventUsers();

        $request->validate([
            'name' => 'required|string',
            'category_mainImage' => 'image'
        ]);

        $cat =  Category::create($request->all());
        $cat->category_mainImage =  ProductController::savePhoto($request->category_mainImage);
        $cat->save();
        return redirect()->route('categories.index');
    }


    public function edit(Category $category)
    {
        $this->preventUsers();
        $searchedOne = Category::find($category->id);
        return view('Category.edit', [
            'category' => $searchedOne
        ]);
    }



    public function update(Request $request, Category $category)
    {
        $this->preventUsers();
        $request->validate([
            'name' => 'required|string',
            'category_mainImage' => 'image'
        ]);

        $updatedOne = Category::find($category->id);
        $updatedOne->name = $request->name;
        $updatedOne->category_mainImage =  ProductController::savePhoto($request->category_mainImage);

        $updatedOne->save();
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $this->preventUsers();
        $category = Category::find($category->id);
        File::delete($category->category_mainImage);
        $category->delete();
        return redirect()->back();
    }
}
