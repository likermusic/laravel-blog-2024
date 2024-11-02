<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register() {
        return view('user.register');
    }

    public function store(Request $request) {
        // dump($request->all());
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:4|max:16',
        ]);

        $req = $request->all();
        $req['password'] = bcrypt($req['password']);
        $user = User::create($req);

        Auth::login($user);

        return redirect()->route('home');
    }
}
