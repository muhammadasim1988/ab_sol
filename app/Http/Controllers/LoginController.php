<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($loginData)) {
            return response()->json(['message' => 'Invalid login credentials'], 401);
        }

        $accessToken = Auth::user()->createToken('API Access Token')->accessToken;
        return response()->json(['user' => Auth::user(),'token' => $accessToken], 200);

    }
}
