<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class authController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view("login.index");
    }
    public function authenticate(Request $request)
    {
      $credentials = $request->validate([
        "email" => "required|email",
        "password" => "required|min:7|max:255"
      ]);
      
      if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended("home");
      }
      
      return back()->with("loginError", "login failed!");
    }
    public function logout(Request $request) {
      Auth::logout();
      
      $request->session()->invalidate();
      $request->session()->regenerateToken();
   
      return redirect('/');
    }
    public function index(){
      return view("register.index");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
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
            "name" => "required|min:3|max:255|unique:users",
            "email" => "required|email|unique:users",
            "password" => "required|min:5|max:255"
          ];
        $validateData = $request->validate($rules);
        $validateData["uid"] = make_uid(16);
        /* encrypt password */
        $validateData["password"] = bcrypt($validateData["password"]);
        User::create($validateData);
        return back()->with("successRegister", "registration successfully, please login!");
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
    public function destroy(User $user)
    {
        //
    }
}
