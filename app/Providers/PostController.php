<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{


    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'description' => $request->description,
            'slug' => Str::slug($request->title)
        ]);

        return redirect()->route('posts.index');
    }




    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('user_id', Auth::id())->first();
        if($post == null){
            return 'hgello';
        }

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post = Post::find($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->slug = Str::slug($request->title);

        $post->save();

        return redirect()->back();
    }


    public function softDelete($id)
    {
        Post::find($id)->delete();
        return redirect()->back();
    }

    public function destroy($id)
    {
        Post::withTrashed()->where('id', $id)->forceDelete();
        return redirect()->back();
    }
}
