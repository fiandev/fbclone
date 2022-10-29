<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Response;
class PostController extends Controller
{
    public function show(Post $post) {
      return view("posts.index", [
          "post" => $post
        ]);
    }
    public function response(Post $post){
      $userId = auth()->user()->id;
      $responses = $post->responses;
      foreach ($responses as $response){
        $userResponseId = $response->user_id;
        if ($userId === $userResponseId) {
        Response::destroy($response->id);
        return [
          "code" => 200,
          "status" => "success",
          "message" => "deleted response for this post!",
          "total_responses" => $post->responses->count() - 1
          ];
        }
      }
      $newResponse = Response::create([
          "user_id" => $userId,
          "post_id" => $post->id,
          "like" => true
        ]);
      return [
        "code" => 200,
        "status" => "success",
        "message" => "added response for this post!",
        "total_responses" => $post->responses->count() + 1
        ];
    }
}
