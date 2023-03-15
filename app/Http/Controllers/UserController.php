<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['status'=>0,'data' => Auth::user()->load('user_interests')], 200);
    }
}
