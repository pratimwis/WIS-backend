<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
  function login()
  {
    return view('login');
  }
  function register()
  {
    return view('register');
  }


  function loginPost(Request $request)
  {
    $request->validate([
      'email' => 'required',
      'password' => 'required|min:3',
      'userType' => 'required',
    ]);
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
      $user = Auth::user();
      // Check if the userType matches
      if ($user->userType !== $request->userType) {
        Auth::logout();
        return redirect(route('login'))->with("error", "Invalid user type.");
      }
      return redirect()->intended(route('dashboard'));
    }
    return redirect(route(name: 'login'))->with("error", "Login details are not valid");
  }
  

  function registerPost(Request $request)
  {
    $request->validate([
      'name' =>'required',
      'email' => 'required',
      'password' => 'required|min:3',
      'userType' => 'required',

    ]);
    $data['name'] = $request->name;
    $data['email'] = $request->email;
    $data['password'] = bcrypt($request->password);
    $data['userType'] = $request->userType;
    $user = User::create($data);
   
    if(!$user){
      return redirect(route(name: 'register'))->with("error", "Failed to register. Please try again.");
    }
    return redirect(route(name:'login'))->with("sucessfully registered");
  }

}
