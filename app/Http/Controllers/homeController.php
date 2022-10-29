<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class homeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view("home.index", [
          "posts" => Post::latest()->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
          "content" => "required|max:255",
          "media" => "file|mimes:jpeg,jpg,png,mp4, mov|max:15360"
          /* 
          15360 = 15mb
          */
        ];
        $validateData = $request->validate($rules);
        $data = [
          "user_id" => auth()->user()->id,
          "slug" => uniqid("post_"),
          "content" => $validateData["content"],
        ];
        if ($request->file("media")) {
          $imageUrl = $request->file("media")->store("static-files");
          $data["media"] = $imageUrl; 
          $data["mediaType"] = $request->file("media")->getMimeType();
        }
        
        $newPost = Post::create($data);
        return redirect("/")->with("success", "your post has been published!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
