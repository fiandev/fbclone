<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DB;

class friendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $request_friendship = auth()->user()->request_friendship;
      $user = auth()->user();
      $friends = [];
     foreach ($request_friendship as $id) {
       $friend = $user->where("id", $id)->get();
       array_push($friends, $friend->first());
     }
     
     return view("friends.index", [
        "requestFriendships" => collect($friends),
        "suggestion" => User::where("id", "!=", $user->id)->get()
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
        /* acc friendship */
        if ($request->accUserId) {
          $id = intval($request->accUserId);
          $request_friendship = auth()->user()->request_friendship;
          $userAuth = auth()->user();
          $userToBeFriend = User::where("id", $id)->first();
          $index = array_search($id, $request_friendship);
          if ($index !== false) {
            /* add friend ship */
           $userAuth->friends()->attach([$id]);
           $userToBeFriend->friends()->attach([$userAuth->id]);
            /* remove user id */
            unset($request_friendship[$index]);
            auth()->user()->request_friendship = $request_friendship;
            
            /* save changed */
            
            $userAuth->save();
            $userToBeFriend->save();
          }
          
          /* back */
          return back();
        }
        
        /* send request friendship */
        if ($request->userIdToBeFriend) {
          $user = User::where("id", $request->userIdToBeFriend)->first();
          /* request friendship */
          $listRequest = $user->request_friendship;
          array_push($listRequest, auth()->user()->id);
          $user->request_friendship = $listRequest;
          $user->save();
          return back()->with("success", "send request");
        }
        
        /* delete friend */
        if ($request->friendIdToDelete) {
          if (!isFriend($request->friendIdToDelete)) {
            abort(403);
          }
          $friendToDelete = User::where("id", $request->friendIdToDelete)->first();
          $userLogged = auth()->user();
          
          /* delete friendlist */
          $friendToDelete->friends()->detach([$userLogged->id]);
          $userLogged->friends()->detach([$friendToDelete->id]);
          return back()->with("success", "$friendToDelete->name has been deleted from friend lists!");
        }
        
        /* cancel request friendship */
        if ($request->userIdToBeCancel) {
          $userToBeCancel = User::where("id", $request->userIdToBeCancel)->first();
          $userAuth = auth()->user();
          
          $request_friendship = $userToBeCancel->request_friendship;
          /* 
          check jika id $userAuth ada di  $userToBeCancel->request_friendship 
          */
          $index = array_search($userAuth->id, $request_friendship);
          if ($index !== false) {
            /* unset value of index */
            unset($request_friendship[$index]);
            
            $userToBeCancel->request_friendship = $request_friendship;
            
            $userToBeCancel->save();
            return [
              "status" => 200,
              "message" => "success canceled request"
              ];
          } else {
            abort(404);
          }
        }
        
        
        /* delete friend requests */
        if ($request->UserIdToBeReject) {
          $idToBeReject = intval($request->UserIdToBeReject);
          $userAuth = auth()->user();
          
          $request_friendship = $userAuth->request_friendship;
          /* delete from index by id */
          $index = array_search($idToBeReject, $request_friendship);
          if ($index !== false) {
            unset($request_friendship[$index]);
            $userAuth->request_friendship = $request_friendship;
            $userAuth->save();
            return back();
          }
          abort(403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request;
    }
}
