<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(['auth','verified'], except:['index', 'show']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view('posts.index',['posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $fields=$request->validate([
           'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
        ]);

        $path=null;
        if ($request->hasFile('image')) {
            $path= Storage::disk('public')->put('posts_images',request()->image);

        }


        $post = Auth::user()->posts()->create([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'image' => $path,
        ]);

        Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(),$post));


        return back()->with('success','Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('modify',$post);
        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        Gate::authorize('modify',$post);

        $fields=$request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',

        ]);

        $path=$post->image ?? null;
        if ($request->hasFile('image')) {
            if ($post->image){
                Storage::disk('public')->delete($post->image);
            }
            $path= Storage::disk('public')->put('posts_images',request()->image);

        }

        $post->update([
            'title' => $fields['title'],
            'body' => $fields['body'],
            'image' => $path,
        ]);

        return redirect()->route('dashboard')->with('success','Post edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('modify',$post);
        if ($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return back()->with('success','Post deleted successfully');
    }


}
