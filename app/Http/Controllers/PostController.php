<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postDetail($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('post-details',compact('post'));
    }
    public function index()
    {
        return view('posts');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'small_description' => 'required|min:10|max:200',
            'description' => 'required|min:500',
            'image' => 'nullable|image',
        ]);
        $image_name = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_o = $image->getClientOriginalName();
            $image_name = rand(10,1000).$image_o;
            $image->move(public_path('storage/images/'),$image_name);
        }
            Post::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'small_description' => $request->small_description,
                'description' => $request->description,
                'category_id' => $request->category_id,
                'user_id' => auth()->user()->id,
                'image' => $image_name
            ]);
        return redirect()->route('admin.posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(int $post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('admin.edit-post',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $data = $request->validate([
            'title' => 'required|unique:posts,title,'.$post->id,
            'category_id' => 'required',
            'small_description' => 'required|min:10|max:200',
            'description' => 'required|min:500',
            'new_image' => 'nullable|image',
        ]);
        $image_name = $post->image;
        if ($request->hasFile('new_image')) {
            if ($post->image) {
                try {
                    unlink('storage/images/'.$post->image);
                } catch (\Throwable $th) {
                    
                }
            }
            $image = $request->file('new_image');
            $image_o = $image->getClientOriginalName();
            $image_name = rand(10,1000).$image_o;
            $image->move(public_path('storage/images/'),$image_name);
            
        }
        $post->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'small_description' => $request->small_description,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'image' => $image_name
        ]);
        $post->save();
        return redirect()->route('admin.posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
