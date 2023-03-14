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
            return response()->json(['status'=>1,'error' => 'Invalid login credentials'], 401);
        }

        $accessToken = Auth::user()->createToken('API Access Token')->accessToken;
        return response()->json(['status'=>0,'user' => Auth::user(),'token' => $accessToken], 200);

    }
}
