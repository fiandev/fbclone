<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class commentController extends Controller
{
  public function index(Post $post, Request $request){
    return view("posts.comments", [
      "post" => $post
    ]);  
    //return $post->load("comments", "responses");
  }
  public function store(Post $post, Request $request){
    $rules = [
          "comment" => "required|max:1000"
        ];
    if ($validateData = $request->validate($rules)) {
      $postId = $post->id;
      $newComment = Comment::create([
          "post_id" => $postId,
          "user_id" => auth()->user()->id,
          "comment" => $validateData["comment"]
        ]);
      return [
          "code" => 200,
          "status" => "success",
          "by" => auth()->user(),
          "comment" => strip_tags($validateData["comment"])
        ];
    } else {
      return back()->with("sendCommentError", "can't sending your comment!")->withInput();
    }
  }
  public function update(){
    
  }
  public function destroy(){
    
  }
}