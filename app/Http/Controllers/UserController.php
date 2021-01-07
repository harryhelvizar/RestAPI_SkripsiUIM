<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // buat function register
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::create([
            'email' => $email,
            'password' => $password
        ]);

        return response()->json(['message' => 'Success'], 201);
    } 

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);

        $email = $request->input('email');
        $password= $request->input('password');

        $user = User::where('email', $email)->first();
        if(!$user) {
            return response()->json(['message' => 'login failed'], 401);
        }

        $isValidPassword = User::where('password', $password)->first();
        if(!$isValidPassword) {
            return response()->json(['message' => 'login failed, password salah!'], 401);
        }

        $generateToken = bin2hex(random_bytes(40));
        $user->update([
            'token' => $generateToken
        ]);

        return response()->json($user);
    }
}
