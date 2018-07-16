<?php

namespace SocialNetwork\Http\Controllers;

use SocialNetwork\Models\User;

use Illuminate\Http\Request;

use SocialNetwork\Http\Requests;
use SocialNetwork\Http\Controllers\Controller;


class AuthController extends Controller
{
    // Get the signed up user
    public function getSignup() 
    {
        return view('auth.signup');
    }

    // Sign the user up
    public function postSignup(Request $request)
    {
        $this->validate($request, [
             'email' => 'required|unique:users|email|max:255',
             'username' => 'required|unique:users|alpha_dash|max:20',   
             'password' => 'required|min:6'   
        ]);

        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()
        ->route('home')
        ->with('info', 'Your account has been created and you can now sign in');
        // return redirect()->route('home')->withInfo('bla bla bla');
    }
}
