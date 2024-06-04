<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function getSignUp(Request $request) {
        return view('signup');
    }

    public function getSignIn(Request $request) {
        return view('signin');
    }

    public function postSignUp(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:4|unique:users,username',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'password2' => 'required|min:8|same:password'
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $createUser = User::create([
            'username' => $validate['username'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password'])
        ]);

        Auth::login($createUser);
        return redirect('/')->with('success', 'Hello '.auth()->user()->username.', welcome to MoneySavers!');
    }

    public function postSignIn(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) return back()->withErrors($validator->errors())->withInput();
        $validate = $validator->validate();

        $getUser = User::where('username', $validate['username'])->get()->first();
        if (!$getUser || !Hash::check($validate['password'], $getUser->password)) return back()->withErrors(['errors' => 'Username or Password is Invalid'])->withInput();

        Auth::login($getUser);
        return redirect('/')->with('success', 'Hello '.auth()->user()->username.', welcome back!');
    }

    public function postSignOut(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/signin')->with('success', 'Successfully Sign Out!');
    }
}
